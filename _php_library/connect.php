<?php
	@session_start();
	$_SESSION['con']=@mysqli_connect("127.0.0.1", "root", "Password123", "booking") or die("NO");
	if($_SESSION['con']){mysqli_query($_SESSION['con'], "SET NAMES utf8");}
	else{echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();}
?>