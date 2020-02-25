<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
$zone=$_GET['zone'];
$datas=get_position_and_status($zone);
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="./_css/ChoosingPage.css" type="text/css">
		<title>感恩牆劃位系統>選擇位置</title>
	</head>
	<body>
        <div id="id_container_picture" class="container grid Bob">
            <img class="layer_picture box_picture" src="./_files/canvas/test_breakfast_part_<?php echo $zone;?>.jpg"
                alt=" This is a painting picture.">
            <div id="id_container_parts" class="container grid Alice">
            <?php if(!empty($datas)):?>
                <?php foreach($datas as $row):?>
                    <div class='layer_parts box_parts' onclick=LinkTo_BookingPage("<?php echo $row['POS'] ?>")><?php echo $row['POS'].', 狀態:'.$row['STATUS'];?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <h3>PHP's get_position_and_status() return error!</h3>
			<?php endif; ?> 
            </div>
        </div>
        <input type="button" onclick="history.back()" value="回到上一頁"></input>
	</body>
</html>
<script>
    function LinkTo_BookingPage(pos) {
        window.location.href = 'BookingPage.php?pos='+pos;
    }
</script>
<?php mysqli_close($_SESSION['con']); ?>