<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (!isset($_SESSION['database'])||!isset($_SESSION['username'])||!isset($_SESSION['password'])) {
	die("Khong the ket noi!");
}
// define('DB_NAME', "{$_SESSION['database']}");
// define('DB_USER', "{$_SESSION['username']}");
// define('DB_PASSWORD', "{$_SESSION['password']}");
define('DB_NAME', "farm1");
define('DB_USER', "ctho");
define('DB_PASSWORD', "ctho");
define('DB_HOST', 'localhost');
$connect = @mysql_pconnect(DB_HOST, DB_USER, DB_PASSWORD) or die ('Can\'t connect to database ->'.mysql_error());
//Ket noi thu den CSDL
@mysql_select_db("farm1", $connect) or die('Can\'t select database ->' .mysql_error());
mysql_query("SET NAMES 'UTF8'");
?>