<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
$zone=$_GET['zone'];
$datas=get_position_and_status($zone);
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
    <div class="canvas_container">
        <img class="img_Property" src="./_files/canvas/test_breakfast.jpg" alt=" This is a painting picture.">
        <div id="id_grid_container" class="grid_container">
            <!--此處用js:grid_item_generate()嵌入畫布的顯示方塊-->
            <?php if(!empty($datas)):?>
            <?php foreach($datas as $row):?>
            <?php if($row['STATUS']==0): ?>
            <div class='grid_item' onclick="LinkTo_BookingPage('<?php echo $row['POS']; ?>')"
                onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')"
                onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
                <?php echo $row['POS']; ?>
            </div>
            <?php elseif($row['STATUS']==1): ?>
            <div class='grid_item lock'
                onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')"
                onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')"><?php echo $row['POS']; ?></div>
            <?php elseif($row['STATUS']==-1):?>
            <div class='grid_item lock'
                onmouseenter="show_state(this, '<?php echo $row['STATUS']; ?>', '<?php echo $row['POS']; ?>')"
                onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')"><?php echo $row['POS']; ?></div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php else: ?>
            <h3>PHP's get_position_and_status() return error!</h3>
            <?php endif; ?>
        </div>
    </div>
    <input type="button" onclick="location.href='HomePage.php'" value="回到上一頁">
</body>

</html>
<script>
    function LinkTo_BookingPage(pos) {
        window.location.href = 'BookingPage.php?pos=' + pos;
    }

    function show_state(x, status, pos) {
        switch (status) {
            case '0':
                x.innerHTML = '<center>' + pos + ':空位<br>可以選取</center>';
                break;
            case '1':
                x.innerHTML = '<center>' + pos + ':已被劃記<br>請考慮其他的位置</center>';
                break;
            case '-1':
                x.innerHTML = '<center>' + pos + ':正被選取<br>請考慮其他的位置</center>';
                break;
            default:
                x.innerHTML = '<center>' + pos + '<br>Something wrong!</center>';
        }

    }

    function set_origin(x, pos) {
        x.innerHTML = pos;
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