<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';

$pos = ($_GET['pos']);
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<style>
		*{
			font-size: 30px;
		}
		body{
			box-sizing: border-box;
			display:flex;
			flex-direction: column;
			align-items: center;
		}
		input[type=text], input[type=submit]{
			width: 100%;
			padding:10px 10px 10px 10px;
		}
		textarea{
			width: 100%;
			resize: none;
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
// 定義變數並設定為空值
$resultErr1 = "";
$resultErr2 = "";
//表單已被提交，並且應該對其進行驗證。如果未提交，則跳過驗證並顯示一個空白表單。
if ($_SERVER["REQUEST_METHOD"] == "POST"):
	if(!empty($_POST["n_pos"])):
		$_SESSION['pos'] =$_POST["n_pos"];
	endif;
	if(!empty($_POST["n_name"])):
		$_SESSION['name'] =$_POST["n_name"];
	else:
		$resultErr1 = "姓名不能空白<br>";
	endif;
	if(!empty($_POST["n_pnum"])):
		$_SESSION['telphone_number'] =$_POST["n_pnum"];
	else:
		$resultErr2= "電話號碼不能空白<br>";
	endif;
	if(!empty($_POST["n_msg"])):
		$_SESSION['message'] =$_POST["n_msg"];
	endif;
	if(isset($_SESSION['name'])&&isset($_SESSION['telphone_number'])):
	header('location: CheckingPage.php');
	echo 'session is ready';
	endif;
endif;
?>

	<?php if(get_status($pos)==0): ?>
	<?php
		/*此處要回傳block至DB */
	?>

		<form method="POST" action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"]))."?pos=$pos";?>">	
			位置:<?php echo $pos; ?>
			<input type="hidden" id="id_pos" name="n_pos" value="<?php echo $pos; ?>"></input><br><br>
			姓名:
			<input type="text" id="id_name" name="n_name" value="<?php echo form_echo_check('name') ?>"></input><br>
			<span class="error"> <?php echo $resultErr1;?></span><br>
			性別：
			<input type="text" id="id_gender" name="n_gender" value="<?php echo form_echo_check('gender') ?>"></input><br>
			<span class="error"></span><br>
			手機號碼:
			<input type="text" id="id_pnum" name="n_pnum" value="<?php echo form_echo_check('telphone_number') ?>"></input><br>
			<span class="error"> <?php echo $resultErr2;?></span><br>
			Email：
			<input type="text" id="id_email" name="n_email" value="<?php echo form_echo_check('gender') ?>"></input><br>
			<span class="error"></span><br>
			Line ID:
			<input type="text" id="id_lineid" name="n_lineid" value="<?php echo form_echo_check('gender') ?>"></input><br>
			<span class="error"></span><br>
			請說說你的故事或任何想法:<br>
			<textarea id="id_msg" name="n_msg" cols="30" rows="5" value="<?php echo form_echo_check('message') ?>"></textarea><br>
			<input type="submit" value="訂位"></input>
		</form>
		<!--input type ="button" onclick="history.back()" value="回到上一頁"></input-->	
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