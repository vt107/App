<div class="php-included">
<div id="main-content">
	<h2 class="fa-id-card-o"> Nông trại của tôi</h2>
	<h4>Dưới đây là thông tin về nông trại mà bạn đang quản lí.</h4>
</div>
<div class="table-cover">
	<p id="table-title" class="fa-id-card-o"> Thông tin nông trại</p>
	<table class="build-in-table">
<?php
	include 'database.php';
	$result = mysql_query("SELECT * FROM `info`",$connect);
    if(!$result)
    {
        die('Không thể lấy dữ liệu: ' . mysql_error());
    }
    echo "<tr>".
		"<th class=\"fa-skyatlas\"> Tên nông trại</th>".
		"<th class=\"fa-clock-o\"> Ngày đăng ký</th>".
		"<th class=\"fa-user-o\"> Người đại diện</th>".
		"<th class=\"fa-object-group\"> Diện tích</th>".
		"<th class=\"fa-map-marker\"> Địa điểm</th>".
		"<th class=\"fa-map-o\"> Xem trên Google Maps</th>".
	"</tr>";
    while ($row = mysql_fetch_assoc($result))
    {
    	$newDate = date("d/m/Y", strtotime($row['dateofregister']));
    	echo "<tr>".
				"<td>{$row['farmname']}</td>".
				"<td>{$newDate}</td>".
				"<td>{$row['representative']}</td>".
				"<td>{$row['acreage']}</td>".
				"<td>{$row['location']}</td>".
				"<td>{$row['maps']}</td>".
			"</tr>";
    }

?>

	</table> <!-- build-in-table -->
	</div> <!-- table-cover -->
<div>
	<div class="table-cover">
	<p id="table-title" class="fa-tree"> Thông tin các khu vực</p>
	<table class="build-in-table">
		
		<?php 
			$result = mysql_query("SELECT * FROM `area`",$connect);
		    if(!$result)
		    {
		        die('Không thể lấy dữ liệu: ' . mysql_error());
		    }
		    echo "<tr>".
			"<th class=\"fa-sort-numeric-asc\"> ID khu vực</th>".
			"<th class=\"fa-object-group\"> Diện tích</th>".
			"<th class=\"fa-sort-numeric-asc\"> ID cây trồng</th>".
			"<th class=\"fa-tree\">Tên cây trồng</th>".
		"</tr>";
		    while ($row = mysql_fetch_assoc($result))
		    {
		    	echo "<tr>".
						"<td>{$row['areaid']}</td>".
						"<td>{$row['acreage']}</td>".
						"<td>{$row['plantid']}</td>".
						"<td>{$row['nameofplant']}</td>".
					"</tr>";
		    }
		 ?>
	</table> <!-- build-in-table -->
	<button class="button-add" id="show-add-area-modal" style="margin-bottom: 13px !important;">Thêm/cập nhật khu vực</button>
	</div> <!-- table-cover -->
	</div>
	<div id="area-modal" class="modal">
	<div class="small-modal" id="small-modal">
		<div class="modal-header">
	    <p>Thêm/cập nhật khu vực</p>
	  </div>
	  <!-- Modal content -->
	  <div class="modal-content" style="background-image: url(img/vuonrau.jpg); background-repeat: no-repeat; background-size: 100%; color: white;">
	    <span class="close">&times;</span>
	    <form class="insert-form">
	    	<input class="input_area" placeholder="ID (số)" type="number" min="1" max="50" id="add-id" required="" value="" tabindex="1">
	    	<input class="input_area" placeholder="Diện tích (m²)" type="number" type="number" min="1" max="200000" id="add-de" required="" value="" tabindex="2">
    		Chọn loại cây   <select class="select-box" id="plantid" style="margin-top: 10px; margin-left: 5px; background-color: transparent; color: white; border: 3px solid #37ce85;" tabindex="3">
	    		<option value="1" selected="" style="background-color: #37ce85;">1 - Cà chua</option>
	    		<option value="2" style="background-color: #37ce85;">2 - Xà lách</option>
    		</select>
	    	
	    </form>
	  </div>
		<div class="modal-footer">
	    <button class="button-add" id="add-area" style="margin: auto; background-color: #33CCCC !important; border-radius: 5px;" tabindex="4" >+ Thêm/cập nhật khu vực</button>
	    <button class="button-add" id="delete-area" style="margin: auto; background-color: #33CCCC !important; border-radius: 5px;">Xóa</button> Nếu xóa chỉ cần nhập ID
	  </div>
	  </div> <!-- small-modal -->
	</div> <!-- Modal -->
	<script>
	// Get the modal
	var modal = document.getElementById('area-modal');

	// Get the small modal
	var small_modal = document.getElementById('small-modal');

	// Get the button that opens the modal
	var add = document.getElementById("show-add-area-modal");

	// Get add_area button
	var add_area = document.getElementById("add-area");

	// Get delete_area button
	var delete_area = document.getElementById("delete-area");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	add.onclick = function() {
	    modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}
	// When the user clicks on <span> (x), close the modal
	delete_area.onclick = function() {
	    var add_area_id = document.getElementById("add-id").value;
	    if(add_area_id==0)
	    	return;
	    $.ajax({
        url : "php/add-area.php",
        type : "post",
        dateType:"text",
        data : {
             delete: add_area_id
        },
        success : function (result){
            result = String(result);
            if(result=="OK")
            {
            	menu_load("myfarm","1");
            }
            else
            {
            	alert("Lỗi: ".result);
            	modal.style.display = "none";
            }
        }
    });
	}
	// When the user clicks the add_area button
	add_area.onclick = function() {
	    var add_area_id = document.getElementById("add-id").value;
	    var add_area_de = document.getElementById("add-de").value;
	    var add_area_pkid = document.getElementById("plantid").value;
	    var plname;
	    if((add_area_id==0)||(add_area_de==0))
	    	return;
	    switch(add_area_pkid) {
    	case "1":
        	plname = "Cà chua";
        	break;
    	case "2":
        	plname = "Xà lách";
        	break;
    	default:
        	//
		}
	    $.ajax({
        url : "php/add-area.php",
        type : "post",
        dateType:"text",
        data : {
             id : add_area_id,
             de : add_area_de,
             plid : add_area_pkid,
             plname : plname
        },
        success : function (result){
            result = String(result);
            if(result=="OK")
            {
            	menu_load("myfarm","1");
            }
            else
            {
            	alert(result);
            	alert("Có lỗi, vui lòng thử lại!");
            	modal.style.display = "none";
            }
        }
    });
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	    if (event.target == small_modal) {
	        modal.style.display = "none";
	    }
	}
	</script>
</div> <!-- php-included -->