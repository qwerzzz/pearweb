<?php
/*
   +----------------------------------------------------------------------+
   | PEAR Web site version 1.0                                            |
   +----------------------------------------------------------------------+
   | Copyright (c) 2001-2003 The PHP Group                                |
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

/**
 * On 404 error this will search for a package with the same
 * name as the requested document. Thus enabling urls such as:
 *
 * http://pear.php.net/Mail_Mime
 */

/**
 * Requesting something like /~foobar will redirect to the account
 * information page of the user "foobar".
 */
if ($_SERVER['REDIRECT_URL']{1} == '~') {
    $user = substr($_SERVER['REDIRECT_URL'], 2);
    if (preg_match(PEAR_COMMON_USER_NAME_REGEX, $user) && user::exists($user)) {
        localRedirect("/account-info.php?handle=" . urlencode($user));
    }
}

$pkg = strtr($_SERVER['REDIRECT_URL'], "-","_");
$pinfo_url = '/package/';

// Check strictly
$sql = "SELECT name
            FROM packages
            WHERE approved = 1 AND name = ?";
$name = $dbh->getOne($sql, array(basename($pkg)));
if (!DB::isError($name) && !empty($name)) {
    localRedirect($pinfo_url . $name);
}

// Check less strictly if nothing has been found previously
$sql = "SELECT p.id, p.name, p.summary
            FROM packages p
            WHERE approved = 1 AND name LIKE ?
            ORDER BY p.name";
$term = "%" . basename($pkg) . "%";
$packages = $dbh->getAll($sql, array($term), DB_FETCHMODE_ASSOC);

if (count($packages) > 3) {
	$packages = array($packages[0], $packages[1], $packages[2]);
	$show_search_link = true;
} else {
	$show_search_link = false;
}

response_header("Error 404");
?>

<h2>Error 404 - document not found</h2>

<p>The requested document <i><?php echo $_SERVER['REQUEST_URI']; ?></i> was not
found on this server.</p>

<?php if(is_array($packages)) { ?>
	Searching the current list of packages for
	<i><?php echo basename($_SERVER['REQUEST_URI']); ?></i> included the
	following results:
	
	<ul>
	<?php foreach($packages as $p) { ?>
		<li>
			<?php print_link(getURL($pinfo_url . $p['name']), $p['name']); ?><br />
			<i><?php echo $p['summary']; ?></i><br /><br />
		</li>
	<?php } ?>
	</ul>
	
	<?php if($show_search_link) { ?>
		<p align="center">
			<?php print_link(getURL('/package-search.php?pkg_name=' . basename($_SERVER['REQUEST_URI']) . '&bool=AND&submit=Search'), 'View full search results...'); ?>
		</p>
<?php
    }
}
?>

<p>If you think that this error message is caused by an error in the
configuration of the server, please contact
<?php echo make_mailto_link("pear-webmaster@php.net"); ?>.

<?php response_footer(); ?>
