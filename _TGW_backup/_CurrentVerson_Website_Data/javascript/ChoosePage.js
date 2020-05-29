/*當格子被點選後，連結至報名表單頁*/
function LinkTo_BookingPage(pos) {
    /*抓取Protocol與Host*/
    var GetProtocol = window.location.protocol;
    var GetHost = window.location.host;
    /*此連結使用HTTP GET require傳送參數，請保留?pos='+pos*/
    window.location.href = GetProtocol+GetHost+'/%e5%8a%83%e4%bd%8d%e8%b3%87%e6%96%99%e8%a1%a8%e5%96%ae/?pos='+pos;
}

/*依據DB回傳之位置狀態的不同，給予不同的顯示調整*/
function show_state(x, status, pos){
    switch (status) {
        case '1':
            x.innerHTML = '<center>' + pos + ':空位</center>';
            break;
        case '-1':
            x.innerHTML = '<center>' + pos + ':已被劃記</center>';
            break;
        case '0':
            x.innerHTML = '<center>' + pos + ':被報名中</center>';
            break;
        default:
            x.innerHTML = '<center>' + pos + '<br>Something wrong!</center>';
    }
}

/*當滑鼠離開格子之後，讓顯示恢復原設定*/
function set_origin(x, pos){
    x.innerHTML=pos;
}


