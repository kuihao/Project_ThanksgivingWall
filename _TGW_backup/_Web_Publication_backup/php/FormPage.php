<?php
session_start();
/*使用$_SESSION['pos']來接HTTP以GET傳遞的pos，pos為position的簡稱，示意這是哪個位置的表單頁面*/
$_SESSION['pos']=$_GET['pos'];

/*若GET是空值 或 將位置回傳DB查詢為False(此位置狀態為禁止或封鎖)，則將頁面導向"位置發生意外"的通知頁面*/
if(empty($_SESSION['pos']) || (!get_status($_SESSION['pos'])){
    header('location: http://127.0.0.1/%e4%bd%8d%e7%bd%ae%e7%99%bc%e7%94%9f%e6%84%8f%e5%a4%96/')
}
else{/*若GET有值 且 此位置是空位，可以繼續執行*/

}
/*-------位置標籤-------*/
echo $_SESSION['pos'];
