<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./_css/homepage3.css" type="text/css">
	<title>感統</title>
</head>

<body>
	<!-- <div id="id_container_picture" class="container grid2 Bob"> -->
	<div id="id_container_picture" class="CC1">
		<!-- <img class="box_picture" src="./_files/canvas/test_breakfast.jpg" alt=" This is a painting picture."> -->
		<!-- <div id="id_container_parts" class="container grid Alice"> -->
		<div id="id_container_parts" class="CC2">
			<?php for($i=0;$i<16;$i++): ?>
			<?php $zone=chr(ord('A')+$i);?>
			<div class='box_parts' onclick="LinkTo_ChooingPage('<?php echo $zone;?>')"
				onmouseenter="get_emptyseats(this, '<?php echo $zone;?>', <?php echo count_status($zone)?>)"
				onmouseleave="set_origin(this, '<?php echo $zone;?>')">
				<?php echo "第".$zone."區"; ?>
			</div>
			<?php endfor?>
		</div>
		<img class="box_picture" src="./_files/canvas/test_breakfast.jpg" alt=" This is a painting picture.">
	</div>
</body>

</html>
<script>
	function LinkTo_ChooingPage(zone) {
		window.location.href = 'ChoosingPage.php?zone=' + zone;
		/*此處可直接用document.getElementById("id").innerHTML="";取得zone，降低程式碼複雜度*/
		/*活用this可更簡化*/
	}

	function get_emptyseats(x, zone, number_Emptyseat) {
		x.innerHTML = '<center>第' + zone + '區<br>還有' + number_Emptyseat + '空位</center>';
	}

	function set_origin(x, zone) {
		x.innerHTML = '第' + zone + '區';
	}
</script>
<?php mysqli_close($_SESSION['con']); ?>