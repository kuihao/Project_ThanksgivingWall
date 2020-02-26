<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
$pos = $_GET['pos'];
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<style>
		body{
			box-sizing: border-box;
			display:flex;
			flex-direction: column;
			align-items: center;
		}
		#id_msg01{
		resize: none;
		}
		
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>感恩牆>填寫劃位資料</title>
</head>
<body>
	<?php if(get_status($pos)==0): ?>
		<form method="POST" action="http://127.0.0.1/CheckingPage.php">
			Position:<?php echo $pos; ?>
			<input type="hidden" id="id_pos01" name="n_pos01"></input><br>
			Name:
			<input type="text" id="id_name01" name="n_name01"></input><br>
			PhoneNumber:
			<input type="text" id="id_phnum01" name="n_phnum01"></input><br>
			Message:<br>
			<textarea id="id_msg01" name="n_msg01" cols="30" rows="5"></textarea><br>
			<input type="submit" value="訂位"></input>
		</form>
		<input type ="button" onclick="history.back()" value="回到上一頁"></input>	
	<?php else: header('location: ChoosingPage.php');?>
	<?php endif;?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>
<?php/*
Log:
1. update data php function(closy)
2. use session store form and doing check
3. session add rand or token
4. PHP mailler()
*/?>