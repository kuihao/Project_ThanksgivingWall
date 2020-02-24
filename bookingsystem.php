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
	<div>
		<form method="GET" action="http://127.0.0.1/append.php">
			Position:A-01
			<input type="hidden" id="id_pos01" name="n_pos01"></input><br>
			Name:
			<input type="text" id="id_name01" name="n_name01"></input><br>
			PhoneNumber:
			<input type="text" id="id_phnum01" name="n_phnum01"></input><br>
			Message:<br>
			<textarea id="id_msg01" name="n_msg01" cols="30" rows="5"></textarea><br>
			<input type="submit" value="訂位"></input>
		</form>
	</div>
	<input type ="button" onclick="history.back()" value="回到上一頁"></input>	
</body>
</html>