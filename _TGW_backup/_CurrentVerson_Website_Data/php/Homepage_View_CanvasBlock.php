<?php
/**
 * 此檔案為顯示用的PHP(view of homepage with php)
 * 產生欲嵌入id="id_grid_container"的可點選方格
 */
?>
<!--$i可控制要顯示多少個格子-->
<?php for($i=0;$i<16;$i++): ?>
<?php $zone=chr(ord('A')+$i);?>
<div class='grid_item' onclick="LinkTo_ChooingPage('<?php echo $zone;?>')"
    onmouseenter="get_emptyseats(this, '<?php echo $zone;?>', <?php echo get_status_permition_count($zone)?>)"
    onmouseleave="set_origin(this, '<?php echo $zone;?>')">
    <?php echo "第".$zone."區"; ?>
</div>
<?php endfor?>