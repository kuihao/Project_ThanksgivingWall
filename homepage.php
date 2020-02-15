<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
$datas=get_position_status();
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="./_css/homepage.css" type="text/css">
		<title>感恩牆</title>
	</head>
	<body>ㄋ
		<div class="container grid">
			<!--需加入DBphp取圖片--><img class="box" src="../_files/image/test_breakfast.jpg">
			<?php if(!empty($datas)):?>
				<?php foreach($datas as $row):?>
					<?php if($row['STATUS']==0):?>
					<div class="allowable" style="background-color:#82FF82;"><?php echo $row['POS'];?></div>
					<?php else:?>
						<?php if($row['STATUS']==1):?>
						<div class="forbidden" style="background-color:#FFD382;"><?php echo $row['POS'];?></div>
						<?php endif;?>
					<?php endif;?>
				<?php endforeach; ?>
			<?php else: ?>
			<h3>Position datas return error!</h3>
			<?php endif; ?>
		</div>
	</body>
</html>
<script></script>
<?php mysqli_close($_SESSION['con']); ?>