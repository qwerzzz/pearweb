<?php
/*
   +----------------------------------------------------------------------+
   | PEAR Web site version 1.0                                            |
   +----------------------------------------------------------------------+
   | Copyright (c) 2001-2005 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.02 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available at through the world-wide-web at                           |
   | http://www.php.net/license/2_02.txt.                                 |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors:                                                             |
   +----------------------------------------------------------------------+
   $Id$
*/

require_once 'HTML/Form.php';

if (!defined('PEAR_COMMON_PACKAGE_NAME_PREG')) {
    define('PEAR_COMMON_PACKAGE_NAME_PREG', '/^([A-Z][a-zA-Z0-9_]+|[a-z][a-z0-9_]+)$/');
}

auth_require('pear.dev');

$display_form = true;
$width = 60;
$errors = array();
$jumpto = 'name';

/* May seem like overkill, but the prepended get() function checks both GET and POST */
$valid_args = array('submit', 'name','category','license','summary','desc','homepage','cvs_link');
foreach($valid_args as $arg) {
	if(isset($_POST[$arg])) $_POST[$arg] = htmlspecialchars($_POST[$arg]);
	if(isset($_GET[$arg])) $_GET[$arg] = htmlspecialchars($GET[$arg]);
}

$submit = isset($_POST['submit']) ? true : false;

do {
    if ($submit) {
        $required = array('name'    => 'enter the package name',
                          'summary' => 'enter the one-liner description',
                          'desc'    => 'enter the full description',
                          'license' => 'choose a license type',
                          'category'=> 'choose a category');
        foreach ($required as $field => $_desc) {
            if (empty($_POST[$field])) {
                $errors[] = "Please $_desc!";
                $jumpto = $field;
                break 2;
            }
        }

        if (!preg_match(PEAR_COMMON_PACKAGE_NAME_PREG, $_POST['name'])) {
            $errors[] = 'Invalid package name.  PEAR package names must start'
                        . ' with a capital letter and contain only letters,'
                        . ' digits and underscores.';
            break;
        }

        $dbh->expectError(DB_ERROR_CONSTRAINT);
        $pkg = package::add(array(
                                  'name'        => $_POST['name'],
                                  'type'        => 'pear',
                                  'category'    => $_POST['category'],
                                  'license'     => $_POST['license'],
                                  'summary'     => $_POST['summary'],
                                  'description' => $_POST['desc'],
                                  'homepage'    => $_POST['homepage'],
                                  'cvs_link'    => $_POST['cvs_link'],
                                  'lead'        => $auth_user->handle
                                  ));
        $dbh->popExpect();
        if (DB::isError($pkg) && $pkg->getCode() == DB_ERROR_CONSTRAINT) {
            error_handler("The `" . $_POST['name'] . "' package already exists!",
                          "Package already exists");
            exit;
        }
        $display_form = false;
        response_header("Package Registered");
        print "The package `" . $_POST['name'] . "' has been registered in PEAR.<br />\n";
        print "You have been assigned as lead developer.<br />\n";
        print "The " . make_link("/group/", "PEAR Group") . " has been notified and the package will be approved soon.<br />\n";
    }
} while (false);

if ($display_form) {
    $title = "New Package";
    response_header($title);

    print "<h1>$title</h1>\n";

    report_error($errors);

    ?>

<p>
  Use this form to register a new package.
</p>

<p>
 <strong>Before proceeding</strong>, make sure you pick the right name for
 your package.  This is usually done through &quot;community consensus,&quot;
 which means posting a suggestion to the pear-dev mailing list and have
 people agree with you.
</p>

<p>
 Note that if you don't follow this simple rule and break
 established naming conventions, your package will be taken hostage.
 So please play nice, that way we can keep the bureaucracy at a minimum.
</p>

    <?php

    $categories = $dbh->getAssoc("SELECT id,name FROM categories ORDER BY name");
    $form =& new HTML_Form(htmlspecialchars($_SERVER['SCRIPT_NAME']), 'post');

    print "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER['SCRIPT_NAME']) . "\">\n";

    $bb = new BorderBox("Register package", "100%", "", 2, true);

    $bb->horizHeadRow("Package Name", $form->returnText("name", get("name"), 20));
    $bb->horizHeadRow("License", $form->returnText("license", get("license"), 20));
    $cats = $form->returnSelect("category", $categories, get("category"), 1,
                                "--Select Category--");
    $bb->horizHeadRow("Category", $cats);
    $bb->horizHeadRow("Summary", $form->returnText("summary", get("summary"), $width));
    $bb->horizHeadRow("Full description", $form->returnTextarea("desc", get("desc"), $width, 3));
    $bb->horizHeadRow("Additional project homepage", $form->returnText("homepage", get("homepage"), 40));
    $bb->horizHeadRow("CVS Web URL", $form->returnText("cvs_link", get("cvs_link"), 40) .
                                     '<br /><small>For example: http://cvs.php.net/cvs.php/pear/XML_Parser</small>');
    $bb->fullRow($form->returnSubmit("Submit Request", "submit"));
    $bb->end();

    if ($jumpto) {
        print "\n<script language=\"JavaScript\">\n<!--\n";
        print "document.forms[1].$jumpto.focus();\n";
        print "// -->\n</script>\n";
    }

    print "</form>\n";
}

response_footer();

?>
