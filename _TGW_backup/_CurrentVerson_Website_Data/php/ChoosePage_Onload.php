<?php
/* session已於snippet:php_connection全域啟動，此處毋需再啟用 */// session_start();

/*使用$_SESSION['zone']來接HTTP以GET傳遞的zone，zone表示本頁面的區塊*/
$_SESSION['zone']=$_GET['zone'];

/*檢查確定有接收到HTTP GET才連接資料庫做查詢，否則若傳入'空'值，資料庫會回傳所有資料*/
if(isset($_SESSION['zone']) && (!empty($_GET['zone'])) ){
    /*call myphp_function: get_positions()回傳位置,pos指position*/
    $_SESSION['positions']=get_position($_SESSION['zone']);
}else{
    /*若沒接到GET執行這裡*/
    /**
     * 可以做重新導向，但這會對編輯網頁的人員會造成麻煩
     * 畢竟網頁流程，使用者正常使用不會發生錯誤，因此這裡僅做錯誤訊息回報
     */
    echo "本頁面需要搭配網址含有HTTP GET才會正常顯示，若您是網管人員請放心編輯<br>";

    unset($_SESSION['zone']);
    mysqli_close($_SESSION['con']);
    unset($_SESSION['con']);
}