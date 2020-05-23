<?php
session_start();
if(isset($_SESSION['zone']) && !empty($_SESSION['pos_and_status'])){
    foreach($_SESSION['pos_and_status'] as $row){
        if($row['STATUS']==0){
            echo "<div class='grid_item' onclick=\"LinkTo_BookingPage('".$row['POS']."')\" 
            onmouseenter=\"show_state(this, '".$row['STATUS']."', '".$row['POS']."')\" 
            onmouseleave=\"set_origin(this ,'".$row['POS']."')\">";
            echo $row['POS'];
            echo "</div>";
        }
        elseif($row['STATUS']==1){
            echo "<div class='grid_item lock' 
            onmouseenter=\"show_state(this, '".$row['STATUS']."', '".$row['POS']."')\" 
            onmouseleave=\"set_origin(this ,'".$row['POS']."')\">";
            echo $row['POS'];
            echo "</div>";
        }
        elseif($row['STATUS']==-1){
            echo "<div class='grid_item lock' 
            onmouseenter=\"show_state(this, '".$row['STATUS']."', '".$row['POS']."')\" 
            onmouseleave=\"set_origin(this ,'".$row['POS']."')\">";
            echo $row['POS'];
            echo "</div>";
        }
    }
}
else{
    echo "<h3>PHP's get_position_and_status() return error!</h3>";
}
