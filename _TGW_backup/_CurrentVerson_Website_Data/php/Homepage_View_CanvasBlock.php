<?php
/**
 * 此檔案為顯示用的PHP(view of homepage with php)
 * 畫布圖片於此更換
 * 產生欲嵌入id="id_grid_container"的可點選方格
 */
?>
<img class="img_Property" 
    src="<?php echo site_url();?>/wp-content/uploads/2020/05/test_breakfast.jpg"
    alt=" This is a painting picture.">
<div id="id_grid_container" class="grid_container">
    <!--$i可控制要顯示多少個格子-->
    <?php for($i=0;$i<16;$i++): ?>
    <?php $zone=chr(ord('A')+$i);?>
    <div class='grid_item' onclick="LinkTo_ChooingPage('<?php echo $zone;?>')"
        onmouseenter="get_emptyseats(this, '<?php echo $zone;?>', <?php echo get_status_permition_count($zone)?>)"
        onmouseleave="set_origin(this, '<?php echo $zone;?>')">
        <?php echo "第".$zone."區"; ?>
    </div>
    <?php endfor?>
</div>
