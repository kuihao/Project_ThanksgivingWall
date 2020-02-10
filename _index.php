<?php
//載入 connect.php 檔案，讓我們可以透過它連接資料庫
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>測試網站</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
    <link rel="stylesheet" href="_ref/style.css" type="text/css">
    <link rel="shortcut icon" href="./_ref/favicon.ico">
  </head>

  <body>
    <!-- 頁首 -->
    <div class="jumbotron">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <div class="alert alert-danger" role="alert">
				<!--網站標題-->
				<h1 class="text-center">測試網站</h1>			
			<div>

            <!-- 選單 -->
            <ul class="nav nav-pills">
				<li class="active"><a  href="_index.php">首頁</a></li>
				<li><a href="index.php">SQLAdmin</a></li>
				<li><a href="homepage.php">感恩牆</a></li>
			</ul>
          </div>
        </div>
      </div>
    </div>
	
    <!-- 網站內容 -->
    <div class="main">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <div class="alert alert-success text-center" role="alert">
              歡迎來到Bootstrap設計的網站。
            </div>
          </div>
        </div>
      </div>
	  <!--Testing bolck in main-->
	  <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-danger text-center" role="alert">
				<p>test area:0w0</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <div class="footer">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <p class="text-center">
              &copy; <?php echo date("Y")?>
              K.
            </p>
          </div>
        </div>
      </div>
    </div>

    <?php
    //結束mysql連線
    mysqli_close($_SESSION['con']);
    ?>
  </body>
</html>
<script>

</script>
