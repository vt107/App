<?php
include 'database.php';
if(isset($_POST['delete']))
{
	$delete = (int)$_POST['delete'];
	$resul = mysql_query("DELETE FROM `area` WHERE `areaid`='{$delete}'",$connect);
    if(!$resul)
    {
        die('Không thể thực thi: ' . mysql_error());
    }
    // print data
    die("OK");
}
$id = isset($_POST['id']) ? (int)$_POST['id'] : die();
$de = isset($_POST['de']) ? (int)$_POST['de'] : die();
$plid = isset($_POST['plid']) ? (int)$_POST['plid'] : die();
$plname = isset($_POST['plname']) ? $_POST['plname'] : die();

$result = mysql_query("INSERT INTO `farm1`.`area` (`areaid`, `plantid`, `acreage`, `nameofplant`) VALUES ('{$id}', '{$plid}', '{$de}', '{$plname}') ON DUPLICATE KEY UPDATE plantid='{$plid}', acreage='{$de}', nameofplant='{$plname}'",$connect);
    if(!$result)
    {
        die('Không thể thực thi: ' . mysql_error());
    }
    // print data
    die("OK");
?>
