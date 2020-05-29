<?php
/*這份檔案是ajax server用來接ajax request及後端資料庫處理*/
require_once './../php/php_built_connection.php';
require_once './../_MY_PHP_Function/myphpfunction.php';

$ResiveMsg =  $_POST['position'];
$ResiveURL =  $_POST['url'];

// Cross-Origin Resource Sharing Header
header('Access-Control-Allow-Origin: '.$ResiveURL);
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
 
//echo $ResiveMsg."<br>";
set_status_booked($ResiveMsg);
echo "DB update OK";
// print_r($ResiveMsg);
?>