<?php
//include '';
//$ad = isset(var) ? <value if true> : <value if false>;
//$number = isset($_POST['number']) ? (int)$_POST['number'] : false;
//header("Location: myOtherPage.php");
	// if(isset($_SESSION['database']))
	// 	echo "string";
	// unset($_SESSION['database']);

// $conn = mysqli_connect('localhost', 'root', 'tho', 'test') or die ('Can not connect to mysql');
// $query = mysqli_query($conn, 'select * from member');

// $result = array();
 
// if (mysqli_num_rows($query) > 0)
// {
//     while ($row = mysqli_fetch_array($query, MYSQL_ASSOC)){
//         $result[] = array(
//             'username' => $row['username'],
//             'email' => $row['email']
//         );
//     }
// }
// die (json_encode($result));
//-----------------
// if (!isset($_SESSION['database'])||!isset($_SESSION['username'])||!isset($_SESSION['password'])) {
// 	die("Khong the ket noi!");
// }
// define('DB_NAME', "{$_SESSION['database']}");
// define('DB_USER', "{$_SESSION['username']}");
// define('DB_PASSWORD', "{$_SESSION['password']}");
// define('DB_HOST', 'localhost');
// $connect = @mysql_pconnect(DB_HOST, DB_USER, DB_PASSWORD) or die ('Can\'t connect to database');
// //Ket noi thu den CSDL
// $AreaID = isset($_POST['AreaID']) ? (int)$_POST['AreaID'] : die("No area selected!");
// //Tao bien ID de luu tru ID khu vuc
// @mysql_select_db("{$_SESSION['database']}", $connect) or die('Can\'t select database');
// mysql_query("SET NAMES 'UTF8'");
$AreaID = isset($_POST['AreaID']) ? (int)$_POST['AreaID'] : header("Location: ../index.php");;
include 'database.php';
$result = mysql_query("SELECT * FROM `data` WHERE `areaid`= {$AreaID} ORDER BY `data`.`time` DESC limit 1",$connect);
    if(!$result)
    {
        die('Không thể lấy dữ liệu: ' . mysql_error());
    }
    // print data
    if (mysql_num_rows($result)==0) {
    	$return = array('Err' => '1');
    	die(json_encode($return));
    }
    $row = mysql_fetch_assoc($result);
    $return = array('Time' => $row['time'],
    	'AreaID' => $row['areaid'],
    	'Temp' => $row['temp'],
    	'Humid' => $row['humid'],
    	'Light' => $row['light']
     );
    die(json_encode($return));
//echo "{$_SESSION['database']} {$_SESSION['username']} {$_SESSION['password']}";
?>
