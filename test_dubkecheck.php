<?php session_start(); //啟動會話 ?>

<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
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

    <h2>表單驗證</h2>
    <!-- $_SERVER["PHP_SELF"] 將表單資料傳送到頁面本身 -->
    <!-- htmlspecialchars() 函式把特殊字元轉換為HTML實體。這意味著<和>之類的HTML字元會被替換為&lt;和&gt; -->
    <!-- 通過使用 htmlspecialchars() 函式能夠避免 $_SERVER["PHP_SELF"] 被利用 -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        姓名：<input type="text" name="name">
        <br><br>
        密碼：<input type="text" name="password">
        <br><br>
        <input type="submit" name="submit" value="提交">
        <br><br>
        <span class="error"> <?php echo $resultErr;?></span>
    </form>

<?php
//輸出
if(!empty($_SESSION['name']))
echo $_SESSION['name'];
echo "<br>";
if(!empty($_SESSION['pwd']))
echo $_SESSION['pwd'];
?>
</body>

</html>
$_SERVER["PHP_SELF"]可改成下一個網址
then 第一塊session驗證就是放下一個網址