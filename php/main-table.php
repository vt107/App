<?php
//include '';
//$ad = isset(var) ? <value if true> : <value if false>;
//$number = isset($_POST['number']) ? (int)$_POST['number'] : false;
//header("Location: myOtherPage.php");
include 'database.php';
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : die();
$result = mysql_query("SELECT * FROM `data` ORDER BY `data`.`time` DESC limit {$limit}",$connect);
    if(!$result)
    {
        die('Không thể lấy dữ liệu: ' . mysql_error());
    }
    // print data
    echo "<tr>".
				'<th class="fa-tree"> ID khu vực</th>'.
				'<th class="fa-thermometer-three-quarters"> Nhiệt độ</th>'.
				'<th class="fa-mixcloud"> Độ ẩm</th>'.
				'<th class="fa-shower"> Ánh sáng</th>'.
				'<th class="fa-clock-o"> Thời gian</th>'.
			"</tr>";
    while ($row = mysql_fetch_assoc($result))
    {
    	$newDate = date("H:i:s d/m/Y", strtotime($row['time']));
    	echo "<tr>".
				"<td>{$row['areaid']}</td>".
				"<td>{$row['temp']} &ordm;C</td>".
				"<td>{$row['humid']} %</td>".
				"<td>{$row['light']} Lux</td>".
				"<td>{$newDate}</td>".
			"</tr>";
    }
//echo "{$_SESSION['database']} {$_SESSION['username']} {$_SESSION['password']}";
?>
