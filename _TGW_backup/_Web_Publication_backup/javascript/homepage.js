function LinkTo_ChooingPage(zone){
    window.location.href = 'ChoosingPage.php?zone='+zone;
    /*此處可直接用document.getElementById("id").innerHTML="";取得zone，降低程式碼複雜度*/
    /*活用this可更簡化*/
}

function get_emptyseats(x, zone, number_Emptyseat){
    x.innerHTML='<center>第'+zone+'區<br>還有'+number_Emptyseat+'空位</center>';
}

function set_origin(x, zone){
    x.innerHTML='第'+zone+'區';
}
