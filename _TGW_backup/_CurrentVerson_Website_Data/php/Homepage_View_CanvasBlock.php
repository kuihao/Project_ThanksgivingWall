<?php
/*此檔案為顯示用的PHP(view of homepage with php)*/

/*產生欲嵌入id="id_grid_container"的可點選方格*/
/*$i可控制要顯示多少個格子*/
for($i=0;$i<16;$i++){
    /*$zone表示格子編號，目前編16個即A~*/
    $zone=chr(ord('A')+$i);
    echo "<div class=\"grid_item\"
    onclick=\"LinkTo_ChooingPage('".$zone."')\"
    onmouseenter=\"get_emptyseats(this, '".$zone."', ".count_status($zone).")\"
    onmouseleave=\"set_origin(this, '".$zone."' )\">";
    echo "第".$zone."區";
    echo "</div>";
}
