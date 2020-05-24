<?php/*session已於snippet:php_connection全域啟動，此處毋需再啟用*///session_start();?>
<script>
/* 以下為jQuery語法(要使用ajax功能) */
/*當文件準備好*/$(document).on("ready", function(){/*此處可以加入自定義event*/});

$("#id_unlock_bt").on("click", function () {
        var send_position = document.getElementById("id_searching").value;
        if(send_position!=''){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url()."/_TGW_backup/_CurrentVerson_Website_Data/php/Unlock_Status.php"; ?>",
                data: {
                    position: send_position
                },
                dataType: 'html' //設定該網頁回應的會是 html 格式
            }).done(function (data) {
                //成功的時候回傳資料過來用argument:data來接，並可在這裡執行顯示處理
                console.log(data);
                //註冊新增成功，轉跳到登入頁面。
                alert("已解鎖!!");
            }).fail(function (jqXHR, textStatus, errorThrown) {
                //失敗的時候
                alert("有錯誤產生，請看 console log");
                console.log(jqXHR.responseText);
            });
            //一樣要回傳 false 阻止 from 繼續把資料送出去。因為會交由上方的 ajax 非同步處理註冊的動作
            return false;
        }
});


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
</script>