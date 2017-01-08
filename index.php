<?php
	session_start(); 
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
		exit();
	}
	if($_SESSION['username']=="root")
	{
		header("Location: admin/index.php");
		exit();
	}
?>
<DOCTYPE html> <!-- Khai bao voi trinh duyet day la file html -->
<html lang="vi">
<head>
	<title>Demo</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/font/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="style/normalize.css">
	<link rel="stylesheet" type="text/css" href="style/style.css"> <!-- CSS cho website -->
	<script language="javascript" src="jsp/jquery-3.1.1.min.js"></script>
	<script language="javascript" src="jsp/main-function.js"></script>
</head>
<body>
<div id="head">
	<!-- <p class="name">IOT SMART FARMING</p> -->
	<p class="name"><a href="/demo" title="Trang chủ">IOT SMART FARMING</a></p>
	<p id="user-button" class="user-button fa-user-circle-o"> <?php echo " {$_SESSION['name']}"; ?></p>
</div>
<div id="popup-user">
		<ul>
			<li><a href="#">Đổi mật khẩu</a></li>
			<li><a href="php/logout.php">Đăng xuất</a></li>
		</ul>
	</div>
<div id="container">
	<div id="menu">
	</div> <!-- #menu -->
	<div id="importphp">
	<script type="text/javascript">
		menu_load("myfarm","1");
	</script>
	</div>
	<div id="content">
		
	</div> <!-- #content -->
	
</div> <!-- #container -->
</body>
<script type="text/javascript">
	var user_button = document.getElementById('user-button');
	var popup_user = document.getElementById('popup-user');
	var container = document.getElementById('container');
	user_button.onclick = function() {
	    popup_user.style.display = "block";
	}
	container.onclick = function(event) {
	    popup_user.style.display = "none";
	}
</script>
</html>
<!-- $(document).ready(
		function(){
		$("#my-options").click(function(){
			// alert("fff");
			$("#myop").toggleClass("css-select");
		});
	}); -->