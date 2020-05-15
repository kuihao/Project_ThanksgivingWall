<?php
require_once './connect.php';
require_once './functions.php';

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

/*---傳送資料至資料庫---*/
$sql="UPDATE `booking_info` SET `POS`= '$pos',
`NAME`='$name',`GENDER`='$gender',`TEL_PHOME`='$phone_num',`EMAIL`='$email',
`LINEID`='$lineid',`NOTIFY_WAY`='$note',`RENOTE_DATE`='$notedate',
`STORY`='$msg',
`STATUS`='1',
`REG_DATE`= '$thistime'
 WHERE `POS`='$pos'";

$rst = mysqli_query($_SESSION['con'], $sql);
if($rst){echo 'OK';}else{echo 'FAIL';}

/*---發送電子郵件---*/
$letter="
    恭喜您劃位成功！<br>
    我們已寄出劃位資訊至您的email<br>
    您劃位的資訊如下:<br>
    ----------------<br>
    位置:".
    $_SESSION['pos']."<br>
    姓名:".
    $_SESSION['name']."<br>
    性別:".
    table_gender($_SESSION['gender'])."<br>
    手機號碼:".
    $_SESSION['phone_number']."<br>
    Email:".
    $_SESSION['email']."<br>
    Line ID:".
    $_SESSION['lineid']."<br>
    提醒通知方式:".
    table_note($_SESSION['note'])."<br>
    請於活動前幾天再次提醒我:".
    $_SESSION['notedate']."<br>
    說說你的故事或任何想法:".
    $_SESSION['msg']."<br>
    系統時間：".
    $_SESSION['updatetime']."<br>
";
$_SESSION['letter'] = $letter;
require_once './sandmail.php';

/*---傳送完畢，跳轉至回應頁面---*/
header('Location:../ResponsePage.php');

mysqli_close($_SESSION['con']); 
?>