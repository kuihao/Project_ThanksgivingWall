<?php
require_once './_php_library/connect.php';

if (isset($_POST['submit'])) { 
	if ($_SESSION['is_submit'] == '0') { 
	$_SESSION['is_submit'] = '1'; 
	echo "程式碼塊，要做的事，程式碼...<a onclick='history.go(-1);' href='javascript:void(0)'>返回</a>"; 
	} else { 
	echo "請不用重複提交<a href='index.php'>PHP SESSION防止表單重複提交</a>"; 
	} 
	}
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
			cols:30; 
			rows:5;
		}
		

		#id_msg01{
		resize: none;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>感恩牆>確認填寫資料</title>
</head>
<body>
<?php
	/*session 先驗證 ，最後確認時再傳至資料庫，思考tolen要用亂數或是T/F*/
	//if(isset($_SESSION['ChooseThisPos'])&&$_SESSION['ChooseThisPos'] == true):
?>
	<form method="POST" action="upload.php">
		位置:
		<input disabled type="text" value="<?php echo $_SESSION['pos']?>"><br>
		姓名:
		<input disabled type="text" value="<?php echo $_SESSION['name']?>"><br>
		性別:
		<input disabled type="text" value="<?php //echo $_SESSION['name']?>"><br>
		手機號碼:
		<input disabled type="text" value="<?php echo $_SESSION['telphone_number']?>"><br>
		Email：
		<input disabled type="text" value="<?php //echo $_SESSION['name']?>"><br>
		Line ID:
		<input disabled type="text" value="<?php //echo $_SESSION['name']?>"><br>
		
		<div width=100%>
		請說說你的故事或任何想法:<br>
		<input disabled type="textarea" value="<?php echo $_SESSION['message']?>"><br>
		</div>

		<input type="submit" value="確認資料無誤，送出">
		<?php /*直接把sesstion資料送至DB 或再使用DB*/ ?>
	</form>
	<input type ="button" onclick="history.back()" value="修改">
<?php
	/*
	else:
		header('location: ChoosingPage.php');
	endif;*/
?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>