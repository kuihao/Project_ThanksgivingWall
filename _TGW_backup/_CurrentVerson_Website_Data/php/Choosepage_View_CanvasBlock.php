<?php
/**
 * 此檔案為顯示用的PHP(view of choosepage with php)
 * 畫布圖片於此更換
 * 產生欲嵌入id="id_grid_container"的可點選方格
 */
?>

<img class="img_Property"
    src="<?php echo site_url()."/wp-content/uploads/2020/05/test_breakfast_part_".$_SESSION['zone'].".jpg";?>"
    alt=" This is a painting picture.">
<div id="id_grid_container" class="grid_container">
    <?php if(!empty($_SESSION['positions'])):?>
    <?php foreach($_SESSION['positions'] as $row):?>
    <?php $status =  get_status_permition($row['POS']); ?>
    <?php if( $status == '1' ): ?>
    <div class='grid_item' onclick="LinkTo_BookingPage('<?php echo $row['POS']; ?>')"
        onmouseenter="show_state(this, '<?php echo $status; ?>', '<?php echo $row['POS']; ?>')"
        onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
        <?php echo $row['POS']; ?>
    </div>
    <?php else: ?>
    <div class='grid_item lock' onmouseenter="show_state(this, '<?php echo $status; ?>', '<?php echo $row['POS']; ?>')"
        onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
        <?php echo $row['POS']; ?>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <h3>PHP's get_status_permition() return error!</h3>
    <?php endif; ?>
</div>
