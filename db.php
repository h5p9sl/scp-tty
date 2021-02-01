<?php
$cfg_ini = parse_ini_file('/var/www/cranscp.ini', true);
$dbcfg = $cfg_ini['mysql_credentials'];

$db_server = $dbcfg['server'];
$db_user = $dbcfg['user'];
$db_passw = $dbcfg['password'];
$db_database = $dbcfg['database'];

$db = mysqli_connect($db_server, $db_user, $db_passw, $db_database);
if (!$db) {
    die("Database connection error: " . mysqli_connect_error());
}

?>
