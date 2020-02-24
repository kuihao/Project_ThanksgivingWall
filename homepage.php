<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
/*$datas=get_position_status();*/
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
    		<img class="layer_picture box_picture" src="./_files/webelement/test_breakfast.jpg" alt=" This is a painting picture.">
    		<div id="id_container_parts" class="container grid Alice"></div>
		</div>
	</body>
</html>
<script>
	function LinkTo_ChoicePage(){
    window.location.href='ChoosingPage.php';
	}
	function SetParts(){
		var i,s;
		for(i=1,s='';i<=16;i++){
			s+="<div class='layer_parts box_parts' onclick=LinkTo_ChoicePage()>第"+i+"區</div>";
		}
		document.getElementById("id_container_parts").innerHTML=s;
	}
	SetParts();
</script>
<?php mysqli_close($_SESSION['con']); ?>