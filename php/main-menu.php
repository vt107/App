<?php
$num_menu = array(20);
for ($i=0; $i < 20; $i++) { 
	$num_menu[$i] = "";
}
$abc = 1;
$selected = isset($_POST['selected']) ? $_POST['selected'] : die();
$num_menu[$selected] = "selected";
echo "<ul>";
echo '<li><a href="#myfarm" id="myfarm" class="'."{$num_menu['1']} fa-id-card-o".'" onclick=\'menu_load("myfarm","1")\'> Nông trại của tôi</a></li>'.
	'<li><a href="#ssinfo" id="ssinfo" class="'."{$num_menu['2']} fa-area-chart".'" onclick=\'menu_load("ssinfo","2")\'> Thông tin môi trường</a></li>'.
	'<li><a href="#plinfo" id="plinfo" class="'."{$num_menu['3']} fa-tree".'" onclick=\'menu_load("plinfo","3")\'> Thông tin cây trồng</a></li>'.
	'<li><a href="#contact" id="contact" class="'."{$num_menu['4']} fa-phone".'" onclick=\'menu_load("contact","4")\'> Gửi hỗ trợ</a></li>'.
"</ul>";
?>