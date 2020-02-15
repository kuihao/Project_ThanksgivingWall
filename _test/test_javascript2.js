function LinkTo_ChoicePage(){
    window.location.href='../bookingsystem.html';
}

function SetParts(){
    var i,s;
    for(i=1,s='';i<=16;i++){
        s+="<div class='layer_parts box_parts' onclick=LinkTo_ChoicePage()>位置A-0"+i+"</div>";
    }
    document.getElementById("id_container_parts").innerHTML=s;
 }
 SetParts();
 