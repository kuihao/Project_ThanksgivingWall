<?php
require_once './connect.php';

echo '傳送資料中，請勿離開本畫面......';

$pos = $_SESSION['pos'];
$name = $_SESSION['name'];
$gender = $_SESSION['gender'];
$phone_num = $_SESSION['phone_number'];
$email = $_SESSION['email'];
$lineid = $_SESSION['lineid'];
$note=json_encode($_SESSION['note']);
$notedate = $_SESSION['notedate'];
$msg = $_SESSION['msg'] ;
$thistime=date('Y-m-d H:i:s');
$_SESSION['updatetime']=$thistime;

$sql="UPDATE `booking_info` SET `POS`= '$pos',
`NAME`='$name',`GENDER`='$gender',`TEL_PHOME`='$phone_num',`EMAIL`='$email',
`LINEID`='$lineid',`NOTIFY_WAY`='$note',`RENOTE_DATE`='$notedate',
`STORY`='$msg',
`STATUS`='1',
`REG_DATE`= '$thistime'
 WHERE `POS`='$pos'";

$rst = mysqli_query($_SESSION['con'], $sql);
if($rst){echo 'OK';}else{echo 'FAIL';}

header('Location:../ResponsePage.php');


mysqli_close($_SESSION['con']); 
?>