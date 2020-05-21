<?php
/*使用$_SESSION['zone']來接HTTP以GET傳遞的zone，zone表示本頁面的區塊*/
session_start();
$_SESSION['zone']=$_GET['zone'];

/*檢查確定有接收到HTTP GET才連接資料庫做查詢，否則若傳入'空'值，資料庫會回傳所有資料*/
if(isset($_SESSION['zone'])){
$_SESSION['pos_and_status']=get_position_and_status($_SESSION['zone']);
}