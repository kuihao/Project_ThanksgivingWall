<!-- 原始碼 -->
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
// 畫布的部分
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
?>

<?php
// php page全包碼
$zone=$_GET['zone'];
$datas=get_position_and_status($zone);
$src = "src=\"http://127.0.0.1/wp-content/uploads/2020/05/test_breakfast_part_".$zone.".jpg\" ";
echo "<div id=\"id_container_picture\" class=\"container grid Bob\">";
echo "<img class=\"layer_picture box_picture\" ".$src." alt=\" This is a painting picture.\">\";";
echo "    <div id=\"id_container_parts\" class=\"container grid Alice\">";

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

echo "    </div>";
echo "</div>";
echo "<input type=\"button\" onclick=\"location.href='HomePage.php'\" value=\"回到上一頁\">";