<?php
require_once './_php_library/connect.php';
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="./_css/homepage.css" type="text/css">
		<title>感恩牆劃位系統</title>
	</head>
	<body>
		<div id="id_container_picture" class="container grid Bob">
    		<img class="layer_picture box_picture" src="./_files/canvas/test_breakfast.jpg" alt=" This is a painting picture.">
    		<div id="id_container_parts" class="container grid Alice">
				<?php for($i=0;$i<16;$i++): ?>
					<?php $zone=chr(ord('A')+$i);?>
					<div class='layer_parts box_parts' onclick=LinkTo_ChooingPage('<?php echo $zone;?>')>
						<?php echo "第".$zone."區"; ?>
					</div>
				<?php endfor?>
			</div>
		</div>
	</body>
</html>
<script>
    function LinkTo_ChooingPage(zone){
        window.location.href = 'ChoosingPage.php?zone='+zone;
    }
</script>
<?php mysqli_close($_SESSION['con']); ?>