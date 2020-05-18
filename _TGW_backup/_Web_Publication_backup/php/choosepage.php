<?php if(!empty($datas)):?>
    <?php foreach($datas as $row):?>
        <?php if($row['STATUS']==0): ?>
            <div class='layer_parts box_parts' onclick="LinkTo_BookingPage('<?php echo $row['POS']; ?>')" onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')" onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
                <?php echo $row['POS']; ?>
            </div>
        <?php elseif($row['STATUS']==1): ?>
            <div class='layer_parts box_parts lock' onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')" onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')"><?php echo $row['POS']; ?></div>
        <?php elseif($row['STATUS']==-1):?>
            <div class='layer_parts box_parts lock' onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')" onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')"><?php echo $row['POS']; ?></div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <h3>PHP's get_position_and_status() return error!</h3>
<?php endif; ?> 

<?php
if(!empty($datas)){
    foreach($datas as $row){
        if($row['STATUS']==0){
            echo "<div class='layer_parts box_parts' onclick=\"LinkTo_BookingPage('".$row['POS']."')\" 
            onmouseenter=\"show_state(this, '".$row['STATUS']."', '".$row['POS']."')\" 
            onmouseleave=\"set_origin(this ,'".$row['POS']."')\">";
            echo $row['POS'];
            echo "</div>";
        }
        elseif($row['STATUS']==1){
            echo "<div class='layer_parts box_parts lock' 
            onmouseenter=\"show_state(this, '".$row['STATUS']."', '".$row['POS']."')\" 
            onmouseleave=\"set_origin(this ,'".$row['POS']."')\">";
            echo $row['POS'];
            echo "</div>";
        }
        elseif($row['STATUS']==-1){
            echo "<div class='layer_parts box_parts lock' 
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
