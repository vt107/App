<?php
define('DB_NAME', "user");
define('DB_USER', "userview");
define('DB_PASSWORD', "tho");
define('DB_HOST', 'localhost');
$connect = @mysql_pconnect(DB_HOST, DB_USER, DB_PASSWORD) or die ('Can\'t connect to database');
//Ket noi thu den CSDL
@mysql_select_db(DB_NAME, $connect) or die('Can\'t select database');
mysql_query("SET NAMES 'UTF8'");
?>