<?php
require_once './_php_library/connect.php';
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
	<title>感恩牆>確認填寫資料</title>
</head>
<body>
<?php
// 定義變數並設定為空值
$resultErr = "";
//表單已被提交，並且應該對其進行驗證。如果未提交，則跳過驗證並顯示一個空白表單。
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"]) || empty($_POST["password"])) {
     $resultErr = "姓名或密碼不能為空";
   }  else {
     //存入session
    $_SESSION['name'] =$_POST["name"];
    $_SESSION['pwd']  = $_POST["password"];
   }   
}
?>

<?php
	/*session 先驗證 ，最後確認時再傳至資料庫，思考tolen要用亂數或是T/F*/
	//if(isset($_SESSION['ChooseThisPos'])&&$_SESSION['ChooseThisPos'] == true):
?>
	<div>
		<form method="GET" action="http://127.0.0.1/append.php">
			Position:<?php ?>
			<input type="hidden" id="id_pos01" name="n_pos01"></input><br>
			Name:
			<input type="hidden" id="id_name01" name="n_name01"></input><br>
			PhoneNumber:
			<input type="hidden" id="id_phnum01" name="n_phnum01"></input><br>
			Message:<br>
			<textarea type="hidden" id="id_msg01" name="n_msg01" cols="30" rows="5"></textarea><br>
			<input type="submit" value="確認資料無誤，送出"></input>
		</form>
	</div>
    <input type ="button" onclick="history.back()" value="回到上一頁"></input>
<?php
	/*
	else:
		header('location: ChoosingPage.php');
	endif;*/
?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>