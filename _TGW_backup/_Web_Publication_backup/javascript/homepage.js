function LinkTo_ChooingPage(zone){
    window.location.href = 'http://127.0.0.1/%e6%84%9f%e6%81%a9%e7%89%86%e5%8a%83%e4%bd%8d%e7%b3%bb%e7%b5%b1%e9%81%b8%e6%93%87%e4%bd%8d%e7%bd%ae/?zone='+zone;
    /*此處可直接用document.getElementById("id").innerHTML="";取得zone，降低程式碼複雜度*/
    /*活用this可更簡化*/
}

function get_emptyseats(x, zone, number_Emptyseat){
    x.innerHTML='<center>第'+zone+'區<br>還有'+number_Emptyseat+'空位</center>';
}

function set_origin(x, zone){
    x.innerHTML='第'+zone+'區';
}

/*產生欲嵌入id="id_grid_container"的可點選方格*/
function grid_item_generate() {
    var i, s = '';
    /*i可控制要顯示多少個格子*/
    for (i = 0; i < 16; i++) {
        s += "<div class=\"grid_item\">" + i + "</div>";
    }
    document.getElementById('id_grid_container').innerHTML = s;
}
grid_item_generate();