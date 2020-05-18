<?php
/*要使用session來裝zone 載入網頁後再清掉即可*/
$zone=$_GET['zone'];
$datas=get_position_and_status($zone);