<?php session_start(); 
	if(!isset($_SESSION['username'])||$_SESSION['username']!='root')
	{
		header("Location: ../index.php");
		exit();
	}
?>
<DOCTYPE html> <!-- Khai bao voi trinh duyet day la file html -->
<html lang="vi">
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style/css-admin.css">
	
</head>
<body>
<div id="head">
	<p class="name"><a href="/demo" title="Trang chủ">IOT SMART FARMING</a></p>
	<button id="user-button"></button>
</div>
	<div id="popup-user">
		<ul>
			<li><a href="#">Đổi mật khẩu</a></li>
			<li><a href="../php/logout.php">Đăng xuất</a></li>
		</ul>
	</div>
<div id="container">
		<?php 
			// include "../../phpmyadmin";
		?>
</div> <!-- #container -->
</body>
<script type="text/javascript">

	//Get user button
	var user_button = document.getElementById('user-button');

	//Get user popup
	var popup_user = document.getElementById('popup-user');

	user_button.onclick = function() {
	    popup_user.style.display = "block";
	}
	window.onclick = function(event) {
	    if ((event.target != user_button)&&(event.target != popup_user)) {
	        popup_user.style.display = "none";
	    }
	}
</script>
</html>