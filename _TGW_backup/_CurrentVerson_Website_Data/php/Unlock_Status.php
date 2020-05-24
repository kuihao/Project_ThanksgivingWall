<?php
/*這份檔案是ajax server用來接ajax request及後端資料庫處理*/
require_once './php_built_connection.php';
require_once './../_MY_PHP_Function/myphpfunction.php';
$ResiveMsg =  $_POST['position'];
echo $ResiveMsg."<br>";

set_status_unlosk($ResiveMsg);

echo "DB update OK";
// print_r($ResiveMsg);
?>