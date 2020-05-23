/*當格子被點選後，連結至選擇位置頁(注意若更改頁面名稱後，此網址也要更換)*/
function LinkTo_ChooingPage(zone){
    /*此連結使用HTTP GET require傳送參數，請保留?zone='+zone;*/
    window.location.href = 'http://127.0.0.1/%e6%84%9f%e6%81%a9%e7%89%86%e9%81%b8%e6%93%87%e4%bd%8d%e7%bd%ae%e9%a0%81/?zone='+zone;
    /*此處也可直接用document.getElementById("id").innerHTML="";取得zone，降低程式碼複雜度*/
    /*若活用this可更簡化*/
}

/*顯示目前格子代表的區域內還有多少空位*/
function get_emptyseats(x, zone, number_Emptyseat){
    x.innerHTML='<center>第'+zone+'區<br>'+number_Emptyseat+'空位</center>';
}

/*當滑鼠離開格子之後，讓顯示恢復原設定*/
function set_origin(x, zone){
    x.innerHTML='第'+zone+'區';
}

/*(捨棄)因為WP的防護機制，只好用php來寫
產生欲嵌入id="id_grid_container"的可點選方格*/
// function grid_item_generate() {
//     var i, s = '';
//     /*i可控制要顯示多少個格子*/
//     for (i = 0; i < 16; i++) {
//         s += "<div class=\"grid_item\">" + i + "</div>";
//     }
//     document.getElementById('id_grid_container').innerHTML = s;
// }
// grid_item_generate();