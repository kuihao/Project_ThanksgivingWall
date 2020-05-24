<?php session_start();
$_SESSION['position'] = 'ABBE423424';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
    <?php echo $_SESSION['position'];?>
    <input type="button" id="id_bt" name="nm_bt" value="按鈕" onclick="JS_call_jQuery()">

</body>
<script>
/* 以下為jQuery語法(要使用ajax功能) */
/*當文件準備好*/$(document).on("ready", function(){/*此處可以加入自定義event*/});
$.AjaxToServer = function() {
    var send_position = "<?php echo $_SESSION['position']; ?>";
    $.ajax({
        type: "POST",
        url: "./../../../_CurrentVerson_Website_Data/php/FormPage_ajax_set_status_booked.php",
        data: {
            position: send_position
        },
        dataType: 'html' //設定該網頁回應的會是 html 格式
    }).done(function (data) {
        //成功的時候回傳資料過來用argument:data來接，並可在這裡執行顯示處理
        console.log(data);
        // if (data == "yes") {
        //     alert("註冊成功，將自動前往登入頁。");
        //     //註冊新增成功，轉跳到登入頁面。
        //     window.location.href = "admin/login.php";
        // } else {
        //     alert("註冊失敗，請與系統人員聯繫");
        // }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //失敗的時候
        // alert("有錯誤產生，請看 console log");
        console.log(jqXHR.responseText);
    });
    //一樣要回傳 false 阻止 from 繼續把資料送出去。因為會交由上方的 ajax 非同步處理註冊的動作
    return false;
};

// 建立 Ajax 物件
request = new ajaxRequest();
function ajaxRequest() {
    try {
        // （除 IE7 之前）支援所有現代瀏覽器
        var request = new XMLHttpRequest();
    } catch (e1) {
        try {
            // （支援 IE6）如果有的話就用 ActiveX 物件的最新版本
            request = new ActiveXObject("Msxml2.XMLHTTP.6.0");
        } catch (e2) {
            try {
                // （支援 IE5）否則就用較舊的版本
                request = new ActiveXObject("Msxml2.XMLHTTP.3.0");
            } catch (e3) {
                // 不支援 Ajax，拋出錯誤
                throw new Error("XMLHttpRequest is not supported");
            }
        }
    }
    return request;
}

/*由Javascript呼叫jQuery function*/
function JS_call_jQuery(){
    $.AjaxToServer();
}
</script>

</html>