<div class="php-included">
<div id="main-content">
	<h2 class="fa-area-chart" aria-hidden="true"> Thông tin môi trường</h2>
</div>

<div id="ssinf">
<div id="divselect">
    <div class="popup">
  		<span class="popuptext" id="myPopup">Khu vực này chưa có dữ liệu!</span>
	</div>
	<?php //Area select
	include 'database.php';
	$result=mysql_query("SELECT AreaID FROM `farm1`.`area` ORDER BY `area`.`AreaID` ASC",$connect);
	if(!$result)
    {
        die('Không thể lấy dữ liệu: ' . mysql_error());
    }
    echo '<span>Chọn khu vực muốn xem &nbsp;</span>'.'<select id="areaselect" class="my-select">';
    while ($row = mysql_fetch_assoc($result)){
    	echo("<option value=\"{$row['AreaID']}\" class=\"my-option\">Khu vực {$row['AreaID']}</option>");
    	}
    echo "</select>".'<input type="button" class="button-add" value="Xem" onclick="load_main_gadget(false)">';
	?> <!-- Vung code cho area select -->
	</div>
		<div>
			
		</div> <!-- Popup -->
		
		<div id="gadget" class="row">
			<div id="AreaID" class="col">
				<i class="fa fa-tree fa-4x gg-img" aria-hidden="true"></i>
				<p class="gadgetvalue" id="Area">2</p>
				<p class="gadgetname" id="Areaname">ID khu vực</p>	
			</div> <!-- AreaID column -->
			<div id="Temp" class="col">
				<i class="fa fa-thermometer-three-quarters fa-4x gg-img" aria-hidden="true"></i>
				<p class="gadgetvalue" id="Tem">33 &ordm;C</p>
				<p class="gadgetname" id="Tempname">Nhiệt Độ</p>
			</div> <!-- Temperature column -->
			<div id="Humid" class="col">
				<i class="fa fa-mixcloud fa-4x gg-img" aria-hidden="true"></i>
				<p class="gadgetvalue" id="Humi">65 %</p>
				<p class="gadgetname" id="Humidname">Độ ẩm</p>

			</div> <!-- Humidnity column -->
			<div id="Light" class="col">
				<i class="fa fa-shower fa-4x gg-img" aria-hidden="true"></i>
				<p class="gadgetvalue" id="Ligh">1233 Lx</p>
				<p class="gadgetname" id="Lightname">Ánh sáng</p>

			</div> <!-- Light column -->
		</div> <!-- gadget -->
		<p class="fa-clock-o text-in-cover-table"> Dữ liệu sẽ được làm mới sau mỗi 10s.</p>
</div> <!-- ssinf -->
		<div class="table-cover">
		<p id="table-title" class="fa-info"> Thông tin nông trại</p>
		<table class="build-in-table" id="sub">
			<tr>
				<th class="fa-tree"> ID khu vực</th>
				<th class="fa-thermometer-three-quarters"> Nhiệt độ</th>
				<th class="fa-mixcloud"> Độ ẩm</th>
				<th class="fa-shower"> Ánh sáng</th>
				<th class="fa-clock-o"> Thời gian</th>
			</tr>
			<tr>
				<td>Đang tải...</td>
				<td>Đang tải...</td>
				<td>Đang tải...</td>
				<td>Đang tải...</td>
				<td>Đang tải...</td>
			</tr>
		</table> <!-- build-in-table -->
		<p class="fa-clock-o text-in-cover-table"> Dữ liệu sẽ được làm mới mỗi 2 giây.</p>
	</div> <!-- table-cover -->
</div> <!-- php-included -->