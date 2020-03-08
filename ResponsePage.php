<?php 
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        *{
			font-size: 25px;
		}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>感恩牆>恭喜您資料已送出</title>
</head>
<body>
    恭喜您劃位成功！<br>
    我們已寄出劃位資訊至您的email<br>
    您劃位的資訊如下:<br>
    ----------------<br>
    位置:
    <?php echo $_SESSION['pos'];?><br>
    姓名:
    <?php echo $_SESSION['name'];?><br>
    性別:
    <?php echo table_gender($_SESSION['gender']);?><br>
    手機號碼:
    <?php echo $_SESSION['phone_number'];?><br>
    Email:
    <?php echo $_SESSION['email'];?><br>
    Line ID:
    <?php echo $_SESSION['lineid'];?><br>
    提醒通知方式:
    <?php echo table_note($_SESSION['note']);?><br>
    請於活動前幾天再次提醒我:
    <?php echo $_SESSION['notedate'];?><br>
    說說你的故事或任何想法:
    <?php echo $_SESSION['msg'];?><br>
    系統時間：
    <?php echo $_SESSION['updatetime'];?><br>
    
    <center><input type="button" onclick="location.href='HomePage.php'" value="回首頁"></center>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>
<?php session_destroy();?>