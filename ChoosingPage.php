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
		<link rel="stylesheet" href="./_css/ChoosingPage.css" type="text/css">
		<title>感恩牆劃位系統>選擇位置</title>
	</head>
	<body>
        <div id="id_container_picture" class="container grid Bob">
            <img class="layer_picture box_picture" src="../_files/webelement/test_breakfast_swap_part1x1.jpg"
                alt=" This is a painting picture.">
            <div id="id_container_parts" class="container grid Alice">
            <?php if(!empty($datas)):?>
                <?php foreach($datas as $row):?>
                    <div class='layer_parts box_parts' onclick=LinkTo_ChoicePage()><?php echo $row['STATUS'].' '.$row['POS'];?></div>
                <?php endforeach; ?>
                <?php else: ?><h3>Position datas return error!</h3>
			<?php endif; ?> 
            </div>
        </div>
        <input type="button" onclick="history.back()" value="回到上一頁"></input>
	</body>
</html>
<script>
    function LinkTo_ChoicePage() {
        window.location.href = 'bookingsystem.php';
    }

    function SetParts() {
        var i, s;
        for (i = 1, s = ''; i <= 16; i++) {
            s += "<div class='layer_parts box_parts' onclick=LinkTo_ChoicePage()>位置A-0" + i + "</div>";
        }
        document.getElementById("id_container_parts").innerHTML = s;
    }
    /*SetParts();*/
</script>
<?php mysqli_close($_SESSION['con']); ?>