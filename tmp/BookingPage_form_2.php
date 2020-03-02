<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
$pos = ($_GET['pos']);/*position*/
$_SESSION['is_submit'] = 0;
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
		.error {
            color: #FF0000;
        }
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>感恩牆>填寫劃位資料</title>
</head>
<body>

<?php
/*php中如何防止表單的重複提交  https://www.w3school.com.cn/php/php_form_complete.asp*/
if (empty($_SESSION['ip'])) {//第一次寫入操作，判斷是否記錄了IP地址，以此知道是否要寫入資料庫
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; //第一次寫入，為後面重新整理或後退的判斷做個鋪墊
//...........//寫入資料庫操作
} else {//已經有第一次寫入後的操作，也就不再寫入資料庫
echo '請不要再次重新整理和後退'; //寫一些已經寫入的提示或其它東西
}
?>

	<?php 
	/*若DB的STATUS=0表示此是空位*/
	if(get_status($pos)==0): 
	/*此處要回傳block至DB */
	?>
		<form method="POST" action="CheckingPage.php">
			Position:<?php echo $pos; ?><br>
			<input type="hidden" id="id_pos" name="n_pos" ></input>
			<input type="hidden" name="token" value="<?php echo $token; ?>" /> 
			Name:
			<input type="text" id="id_name" name="n_name" value=""></input><br>
			<span class="error"> <?php echo $resultErr1;?></span>
			PhoneNumber:
			<input type="text" id="id_pnum" name="n_pnum" value=""></input><br>
			<span class="error"> <?php echo $resultErr2;?></span>
			Message:<br>
			<textarea id="id_msg" name="n_msg" cols="30" rows="5" value=""></textarea><br>
			<input type="submit" value="訂位"></input>
		</form>
		<input type ="button" onclick="history.back()" value="回到上一頁"></input>	
	<?php else: header('location: ChoosingPage.php');?>
	<?php endif;?>

<?php
if ($_SESSION["token"] != $token) { 
// 不讓重複提交，在此處理 
// header("location:".$_SERVER['PHP_SELF']); 
} else { 
// 正常的表單提交，在此處理 
// echo "已提交";  
}

$token = mt_rand(0,1000000);
$_SESSION['token'] = $token;
?>

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