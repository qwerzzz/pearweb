<?php

/*
   +----------------------------------------------------------------------+
   | PEAR Web site version 1.0                                            |
   +----------------------------------------------------------------------+
   | Copyright (c) 2001-2004 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.02 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available at through the world-wide-web at                           |
   | http://www.php.net/license/2_02.txt.                                 |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Tobias Schlitt <toby@php.net>                               |
   |                                                                      |
   +----------------------------------------------------------------------+
   $Id$
*/
require_once 'Damblan/Trackback.php';
require_once 'Damblan/Mailer.php';
require_once 'Damblan/URL.php';
$site = new Damblan_URL;


$params = array('action' => '', 'id' => '');
$site->getElements($params);


$id = htmlentities($params['id']);

// This mostly occurs, when the URL is called by a human instead of a script
if (count($_POST) == 0) {
    PEAR::raiseError("This site is not intended for being viewed in a webbrowser, but to communicate with computer programs.");
}

// Switch error handling, to avoid further PEARWeb style error output
PEAR::setErrorHandling(PEAR_ERROR_RETURN);

// Data sanity check
if (!isset($params['id'])) {
    echo Services_Trackback::getResponseError('No package with ID transmited. Trackback not possible.', 1);
    exit;
}

// Sanity check, if package exists
$pkgInfo = package::info($id, 'packageid');
if (!isset($pkgInfo) || PEAR::isError($pkgInfo)) {
    echo Services_Trackback::getResponseError('No package with ID '.$id.' found. Trackback not possible.', 1);
    exit;
}

// Creating new trackback
$trackback = new Damblan_Trackback(array('id' => $id), time());

$res = $trackback->receive();
if (PEAR::isError($res)) {
    echo Services_Trackback::getResponseError('The data you submited was invalid, please recheck.', 1);
    exit;
}

$res = $trackback->save($dbh);
if (PEAR::isError($res)) { 
    echo Services_Trackback::getResponseError('Your trackback could not be saved, please try again or inform the administrator.', 1);
    exit;
}

$mailData = array(
    'id' => $trackback->id,
    'blog_name' => $trackback->blog_name,
    'title' => $trackback->title,
    'url' => $trackback->url,
    'excerpt' => $trackback->excerpt,
    'date' => make_utc_date($trackback->timestamp),
    'timestamp' => $trackback->timestamp,
);

$mailer = Damblan_Mailer::create('Trackback_New', $mailData);
$additionalHeaders['To'] = $trackback->getMaintainers();
$res = $mailer->send($additionalHeaders);

if (PEAR::isError($res)) {
    echo Services_Trackback::getResponseError('The notification email for your trackback could not be send. Please inform pear-webmaster@lists.php.net.', 1);
    exit;
}

echo Services_Trackback::getResponseSuccess();

?>
