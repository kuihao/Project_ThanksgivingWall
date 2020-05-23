<?php /*這是wordpress的function，此處先覆寫無影響*/function add_action(){};?>
<?php
require_once './../php/php_built_connection.php';
require_once './../_MY_PHP_Function/myphpfunction.php';
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./../css/homepage.css" type="text/css">
    <title>首頁</title>
</head>

<body>
    <div class="canvas_container">
        <img class="img_Property" src="http://127.0.0.1/wp-content/uploads/2020/05/test_breakfast.jpg"
            alt=" This is a painting picture.">
        <div id="id_grid_container" class="grid_container">
            <!--此處用php:Homepage_View_CanvasBlock嵌入畫布的顯示方塊-->
            <?php for($i=0;$i<16;$i++): ?>
            <?php $zone=chr(ord('A')+$i);?>
            <div class='grid_item' onclick="LinkTo_ChooingPage('<?php echo $zone;?>')"
                onmouseenter="get_emptyseats(this, '<?php echo $zone;?>', <?php echo get_status_permition_count($zone)?>)"
                onmouseleave="set_origin(this, '<?php echo $zone;?>')">
                <?php echo "第".$zone."區"; ?>
            </div>
            <?php endfor?>
        </div>
    </div>
</body>
<script src="./../javascript/HomePage.js"></script>
<script>
    /*檔案中的LinkTo_ChooingPage()連結是連至WP的網頁，此處覆寫*/
    function LinkTo_ChooingPage(zone) {
        window.location.href = './single_Choosepage.php/?zone=' + zone;
    }
</script>

</html>
<?php mysqli_close($_SESSION['con']); ?>