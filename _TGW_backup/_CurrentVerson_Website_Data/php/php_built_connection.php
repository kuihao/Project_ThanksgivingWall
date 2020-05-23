<?php
/*(啟用session以使用php全域session變數)*/
@session_start();

/*連線至mysql管理系統中的wpdb資料庫(wpdb是存放Wordpress網站資料的資料庫)*/
$_SESSION['con']=@mysqli_connect("127.0.0.1", "root", "", "wpdb") or die("NO");
if($_SESSION['con']){mysqli_query($_SESSION['con'], "SET NAMES utf8");}
else{echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();}