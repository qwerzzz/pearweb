<?php
require dirname(dirname(__FILE__)) . '/mockDB/DB.php';
set_include_path(dirname(dirname(dirname(__FILE__))) . '/include' . PATH_SEPARATOR .
    get_include_path());
require_once 'DB.php';
$_ENV['PEAR_DATABASE_DSN'] = 'mock://pear:pear@localhost/pear';
// so we do local
$_SERVER['SERVER_NAME'] = 'localhost';
require_once 'pear-prepend.php';
require_once 'pear-auth.php';
$auth_user = new PEAR_Auth;

$options = array(
    'persistent' => false,
    'portability' => DB_PORTABILITY_ALL,
);
$dbh = DB::connect(PEAR_DATABASE_DSN, $options);
$mock = new mockDB_core;
$dbh->setMock($mock);

require dirname(dirname(__FILE__)) . '/phpt_test.php5.inc';
$phpt = new PEAR_PHPTest;

?>