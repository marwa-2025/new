<?php
session_start();
$servername = "localhost";
$username = "root"; // حسب الإعدادات
$password = ""; // حسب الإعدادات
$dbname = "students";
require_once("../classes/datebase.php");

$student = new Database($servername, $dbname, $username, $password );
//user
$user=new User($servername, $dbname, $username, $password );
define('site_name','students');
define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'] . "/students");
?>