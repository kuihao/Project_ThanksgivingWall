function LinkTo_BookingPage(pos) {
    window.location.href = 'BookingPage.php?pos='+pos;
}

function show_state(x, status, pos){
    switch(status){
        case '0':
            x.innerHTML='<center>'+pos+':空位<br>可以選取</center>';
            break;
        case '1':
            x.innerHTML='<center>'+pos+':已被劃記<br>請考慮其他的位置</center>';
            break;
        case '-1':
            x.innerHTML='<center>'+pos+':正被選取<br>請考慮其他的位置</center>';
            break;
        default:
            x.innerHTML='<center>'+pos+'<br>Something wrong!</center>';
    }

}

function set_origin(x, pos){
    x.innerHTML=pos;
}