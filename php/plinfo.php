<div class="php-included">
<div id="main-content">
	<h2 class="fa-tree"> Thông tin cây trồng</h2>
	<h4>Bảng tham khảo thông tin môi trường thuận lợi tương ứng với các loại cây trồng.</h4>
</div>
		<div class="table-cover">
		<p id="table-title" class="fa-tree">Các loại rau</p>
		<table class="build-in-table">
	<?php
		include 'database.php';
			$result = mysql_query("SELECT * FROM `plantinfo`.`vegetable` ORDER BY `vegetable`.`plantid`",$connect);
	    if(!$result)
	    {
	        die('Không thể lấy dữ liệu: ' . mysql_error());
	    }
	    echo "<tr>".
			"<th class=\"fa-sort-numeric-asc\"> ID cây trồng</th>".
			"<th class=\"fa-tree\"> Tên cây trồng</th>".
			"<th class=\"fa-thermometer-three-quarters\"> Nhiệt độ</th>".
			"<th class=\"fa-mixcloud\"> Độ ẩm</th>".
			"<th class=\"fa-shower\"> Ánh sáng</th>".
			"<th class=\"fa-clock-o\"> Thời gian tăng trưởng</th>".
		"</tr>";
	    while ($row = mysql_fetch_assoc($result))
	    {
	    	echo "<tr>".
					"<td>{$row['plantid']}</td>".
					"<td>{$row['name']}</td>".
					"<td>{$row['airtemp']} &ordm;C</td>".
					"<td>{$row['humid']} %</td>".
					"<td>{$row['light']} Lux</td>".
					"<td>{$row['timetoharvest']}</td>".
				"</tr>";
	    }
	?>
	</table> <!-- build-in-table -->
	</div> <!-- table-cover -->
</div> <!-- php-included -->
