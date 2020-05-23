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
<style>
	/*整個物件的最外層容器*/
	.canvas_container{
		/*位置設為relative可被子層的absolute屬性區塊定位*/
		position: relative;
		/*自定義的RWD設定*/
		max-width: 800px;
		min-width:601px;
		/*畫框邊線*/
		border: 1px solid black;
	}

	/*圖片的屬性設定*/
	.img_Property{
		/*<img>做到RWD縮放的必要設定*/
		width: 100%;
		height: auto;
	}

	/*設定Grid格線框架*/
	.grid_container{
		/*位置設為absolute，便會將上層區塊的左上角作為參考點，作出相對位置的改變*/
		position: absolute;
		top: 0;
		left: 0;
		/*寬度設100%永遠填滿這個框架
		"最小高度100%"是本物件會成功的重點，由於位置設為absolute，它會參考父層當前實際的高度作為自己的最低高度*/
		width: 100%;
		min-height: 100%;
		/*將layout模組設為grid(格線框架)：會自動將子層區塊照自定義設定值排列*/
		display: grid;
		/*目前排列規則設為：4列，1fr代表全部的分割比例皆為1:1，W3Cschool會有更多這部分的變形教學*/
		grid-template-rows: repeat(4, 1fr);
		/*目前排列規則設為：4行*/
		grid-template-columns: repeat(4, 1fr); 
		/*間隔：目前設為0，表示無間隔*/
		grid-gap:0;
	}

	/*設定grid框架內的實際的方格*/
	.grid_item{
		/*flex是目前最優的文字排版設定，適合用在最底層*/
		display: flex;
		/*文字區塊xy軸都置中排列*/
		justify-content: center;
		align-items: center;
		/*文字屬性*/
		border: 1px solid white;
		/*格線顏色*/
		color: white;
	}

	/*hover表示滑鼠移置此區塊上方之後的狀態*/
	.grid_item:hover{
		/*滑鼠呈現手指圖案*/
		cursor: pointer;
		/*方格顏色轉變的顏色*/
		background:rgba(0,255,0,50%);
	}
</style>
<body>
	<div class="canvas_container">
        <img class="img_Property" 
            src="http://127.0.0.1/wp-content/uploads/2020/05/test_breakfast.jpg"
            alt=" This is a painting picture.">
        <div id="id_grid_container" class="grid_container">
			<!--此處用js:grid_item_generate()嵌入畫布的顯示方塊-->
			<?php for($i=0;$i<16;$i++): ?>
			<?php $zone=chr(ord('A')+$i);?>
			<div class='grid_item' onclick="LinkTo_ChooingPage('<?php echo $zone;?>')"
				onmouseenter="get_emptyseats(this, '<?php echo $zone;?>', <?php echo count_status($zone)?>)"
				onmouseleave="set_origin(this, '<?php echo $zone;?>')">
				<?php echo "第".$zone."區"; ?>
			</div>
			<?php endfor?>
		</div>
    </div>

	<br>
	<br>

	<div id="id_container_picture" class="CC1">
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

	/*產生欲嵌入id="id_grid_container"的可點選方格*/
	function grid_item_generate() {
        var i, s = '';
		/*i可控制要顯示多少個格子*/
        for (i = 0; i < 16; i++) {
            s += "<div class=\"grid_item\">" + i + "</div>";
        }
        document.getElementById('id_grid_container').innerHTML = s;
    }
    //grid_item_generate();
</script>
<?php mysqli_close($_SESSION['con']); ?>