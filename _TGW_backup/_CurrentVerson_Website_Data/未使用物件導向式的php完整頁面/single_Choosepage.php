<?php /*這是wordpress的function，此處先覆寫無影響*/function add_action(){};?>
<?php
require_once './../php/php_built_connection.php';
require_once './../_MY_PHP_Function/myphpfunction.php';

/*使用$_SESSION['zone']來接HTTP以GET傳遞的zone，zone表示本頁面的區塊*/
$_SESSION['zone']=$_GET['zone'];

/*檢查確定有接收到HTTP GET才連接資料庫做查詢，否則若傳入'空'值，資料庫會回傳所有資料*/
if(isset($_SESSION['zone']) && (!empty($_GET['zone'])) ){
    /*call myphp_function: get_positions()回傳位置,pos指position*/
    $_SESSION['positions']=get_position($_SESSION['zone']);
}else{
    /*若沒接到GET執行這裡*/
    /**
     * 可以做重新導向，但這會對編輯網頁的人員會造成麻煩
     * 畢竟網頁流程，使用者正常使用不會發生錯誤，因此這裡僅做錯誤訊息回報
     */
    echo "本頁面需要搭配網址含有HTTP GET才會正常顯示，若您是網管人員請放心編輯<br>";

    unset($_SESSION['zone']);
    mysqli_close($_SESSION['con']);
    unset($_SESSION['con']);
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://127.0.0.1/_TGW_backup/_CurrentVerson_Website_Data/css/choosepage.css" type="text/css">
    <title>選擇位置頁</title>
</head>

<body>
    <div class="canvas_container">
        <img class="img_Property"
            src="http://127.0.0.1/wp-content/uploads/2020/05/test_breakfast_part_<?php echo $_SESSION['zone'];?>.jpg"
            alt=" This is a painting picture.">
        <div id="id_grid_container" class="grid_container">
            <?php if(!empty($_SESSION['positions'])):?>
            <?php foreach($_SESSION['positions'] as $row):?>
            <?php $status =  get_status_permition($row['POS']); ?>
            <?php if( $status == '1' ): ?>
            <div class='grid_item' onclick="LinkTo_BookingPage('<?php echo $row['POS']; ?>')"
                onmouseenter="show_state(this, '<?php echo $status; ?>', '<?php echo $row['POS']; ?>')"
                onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
                <?php echo $row['POS']; ?>
            </div>
            <?php else: ?>
            <div class='grid_item lock'
                onmouseenter="show_state(this, '<?php echo $status; ?>', '<?php echo $row['POS']; ?>')"
                onmouseleave="set_origin(this ,'<?php echo $row['POS']; ?>')">
                <?php echo $row['POS']; ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php else: ?>
            <h3>PHP's get_status_permition() return error!</h3>
            <?php endif; ?>
        </div>
    </div>
</body>
<script src="http://127.0.0.1/_TGW_backup/_CurrentVerson_Website_Data/javascript/ChoosePage.js"></script>
</html>
<?php mysqli_close($_SESSION['con']); ?>
<?php unset($_SESSION['con']); unset($_SESSION['zone']); unset($_SESSION['positions']);?>