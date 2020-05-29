<?php
/*session已於snippet:php_connection全域啟動，此處毋需再啟用*///session_start();

/*使用$_SESSION['pos']來接HTTP以GET傳遞的pos(position的簡稱)識別這是哪個位置的表單頁面*/
$_SESSION['position']=$_GET['pos'];
/*若在後台編輯模式進入頁面會收到GET:?action=edit/ elementor 或 ?preview=true */
$action = $_GET['action'];
$preview = $_GET['preview'];
/*判斷進入網頁者是否為管理員，是則用$_SESSION['Administrator']標記身分*/
if( ($action == 'edit') || ($action == 'elementor') || ($preview) ){
    $_SESSION['Administrator'] = true;
    /*以JS封鎖送出表單的功能，防止外部使用者得到後台權限*/
    if($_SESSION['Administrator']){
        /*於網頁放置一個附有id_It_is_Administrator的標籤，
        等表單載入完成之後，由footer的javascript檢測id_It_is_Administrator，
        若id存在，則將表單送出位址改為action="#" */
        echo "<span id=\"id_It_is_Administrator\" style=\"visibility:hidden\"></span>";
    }else{echo "Error: session['Admin']授權失敗<br>";}
}

/*確定不是編輯模式，即是正常頁面才繼續以下操作*/
if(empty($_SESSION['Administrator'])){

    /*若GET是空值 或 將位置回傳DB查詢為False(此位置狀態為禁止或封鎖)，則將頁面導向"位置發生意外"的通知頁面*/
    if( empty($_SESSION['position']) || !(get_status_permition($_SESSION['position'])=='1') ){
        /*載入JS並跳址(因為WP本身對php轉址有衝突，官方尚未修復)*/
        echo "<script>window.location.href = \"".site_url()."/%e4%bd%8d%e7%bd%ae%e7%99%bc%e7%94%9f%e6%84%8f%e5%a4%96/\";</script>";
    }else{
        /*若GET有值 且 此位置是空位，則給予可以繼續執行*/
        $_SESSION['FormPage_Certificate'] = true;
    }

    /*當使用者成功進入本頁面，*/
    if($_SESSION['FormPage_Certificate']){
        /*立刻將本位置設為鎖定，目前預設鎖定30分鐘，若使用者中途離開放棄填寫表單，30分鐘後自動解鎖*/
        set_status_blocking( $_SESSION['position'], 30);
    }

}

/*目前使用到的session: $_SESSION['position'/ Administrator/ FormPage_Certificate]*/
