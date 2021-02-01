<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['uid'])) {
    $pagetitle = 'PORTAL';
    include_once 'header.php';
    include_once 'login.php';
    die();
}
?>
