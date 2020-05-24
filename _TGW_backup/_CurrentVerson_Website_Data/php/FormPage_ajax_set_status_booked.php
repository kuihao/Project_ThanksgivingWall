<?php
// require_once './../php/php_built_connection.php';
// require_once './../_MY_PHP_Function/myphpfunction.php';
$ResiveMsg =  $_POST['position'];

function set_status_booked($pos){
    $sql ="UPDATE `booking_info` SET `STATUS`= '2222-01-01 00:00:00' WHERE `POS`='$pos'";
    $rst=@mysqli_query($_SESSION['con'], $sql);
}
//set_status_booked();

// echo $ResiveMsg;
print_r($ResiveMsg);
?>