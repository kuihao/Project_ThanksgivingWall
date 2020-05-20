<?php
for($i=0;$i<16;$i++){
    $zone=chr(ord('A')+$i);
    echo "<div class=\"layer_parts box_parts\"
    onclick=\"LinkTo_ChooingPage('".$zone."')\"
    onmouseenter=\"get_emptyseats(this, '".$zone."', ".count_status($zone).")\"
    onmouseleave=\"set_origin(this, '".$zone."' )\">";
    echo "第".$zone."區";
    echo "</div>";
}
