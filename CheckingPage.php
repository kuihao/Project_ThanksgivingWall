<?php
require_once './_php_library/connect.php';

/*
if (isset($_POST['submit'])) { 
	if ($_SESSION['is_submit'] == '0') { 
	$_SESSION['is_submit'] = '1'; 
	echo "程式碼塊，要做的事，程式碼...<a onclick='history.go(-1);' href='javascript:void(0)'>返回</a>"; 
	} else { 
	echo "請不用重複提交<a href='index.php'>PHP SESSION防止表單重複提交</a>"; 
	} 
}*/
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<style>
		*{
			font-size: 25px;
		}
		body{
			box-sizing: border-box;
			display:flex;
			flex-direction: column;
			align-items: center;
		}
		input[type=text], input[type=submit]{
			padding:10px 0px 10px 0px;
			width:100%;
		}
		textarea{
			padding:10px 0px 10px 0px;
			width:100%;
			resize: none;
		}

		form{
			width:50%;
			display:block;
		}

		.formtitle{
			width:100%;
			background-color: #CDCDEE;
		}
		
		.TITLE{
		    font-size: 30px;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>感恩牆>確認填寫資料</title>
</head>
<body>
<?php
	/*session 先驗證 ，最後確認時再傳至資料庫，思考tolen要用亂數或是T/F*/
	//if(isset($_SESSION['ChooseThisPos'])&&$_SESSION['ChooseThisPos'] == true):
?>
    <span class="TITLE">感恩牆>確認填寫資料</span><br>
	<form method="POST" action="./_php_library/updateinfo.php">
		<center><span class="formtitle">位置:<?php echo $_SESSION['pos'];?></span></center>
		<input disabled type="hidden" id="id_pos" name="n_pos" value="<?php echo $_SESSION['pos'];  ?>">

		<span class="formtitle">*姓名:</span><br>
		<input disabled type="text" id="id_name" name="n_name" value="<?php  echo $_SESSION['name'];?>"><br>

		<?php $rd_Male = $rd_Female = $rd_Other = $rd_Secret = "";?>
		<?php if($_SESSION['gender']):?>
		<?php switch($_SESSION['gender']){
				 case 'Male':
					$rd_Male='checked'; break;
				 case 'Female':
					$rd_Female='checked'; break;
				 case 'Other':
					$rd_Other='checked'; break;
				case 'Secret':
					$rd_Secret='checked'; break;
				 default:
					$rd_Male='';
					$rd_Female='';
					$rd_Other='';
					$rd_Secret='';
				 }?>
		<?php endif;?>
		<span class="formtitle">*性別：</span><br>
		<label><input disabled type="radio" <?php echo $rd_Male;?> id="id_gender" name="n_gender" value="Male">男</label>
		<label><input disabled type="radio" <?php echo $rd_Female;?> id="id_gender" name="n_gender" value="Female">女</label>
		<label><input disabled type="radio" <?php echo $rd_Other;?> id="id_gender" name="n_gender" value="Other">其他</label>
		<label><input disabled type="radio" <?php echo $rd_Secret;?> id="id_gender" name="n_gender" value="Secret">不公開</label><br>

		<span class="formtitle">*手機號碼:</span><br>
		<input disabled type="text" id="id_pnum" name="n_pnum" value="<?php  echo $_SESSION['phone_number'];?>"><br>

		<span class="formtitle">*Email：</span><br>
		<input disabled type="text" id="id_email" name="n_email" value="<?php  echo $_SESSION['email'];?>"><br>

		<span class="formtitle">*Line ID:</span><br>
		<input disabled type="text" id="id_lineid" name="n_lineid" value="<?php  echo $_SESSION['lineid'];?>"><br>

		<?php $cb_email = 'checked'; $cb_line = $cb_pmsg ="";?>
		<?php if($_SESSION['note']):?>
		<?php foreach($_SESSION['note'] as $value):?>
		<?php switch($value){
				 case 'email':
					$cb_email='checked'; break;
				 case 'LINE':
					$cb_line='checked'; break;
				 case 'phonemessage':
					$cb_pmsg='checked'; break;
				 default:
					$cb_email='checked';
				 }?>
		<?php endforeach;?>
		<?php endif; ?>
		<span class="formtitle">*提醒通知方式:</span><br>
		<label><input disabled type="checkbox" <?php echo $cb_email;?> id="id_note" name="n_note[]" value="email">Email</label>
		<label><input disabled type="checkbox" <?php echo $cb_line; ?> id="n_note" name="n_note[]" value="LINE">LINE</label>
		<label><input disabled type="checkbox" <?php echo $cb_pmsg; ?> id="n_note" name="n_note[]" value="phonemessage">手機簡訊</label><br>

		<span class="formtitle">*請於活動前幾天再次提醒我:</span><br>
		<input disabled type="date" id="id_notedate" name="n_notedate" value="<?php  echo $_SESSION['notedate'];?>"><br>

		<span class="formtitle">說說你的故事或任何想法:</span><br>
		<textarea disabled id="id_msg" name="n_msg" cols="30" rows="5"><?php  echo $_SESSION['msg'];?></textarea><br>

		<input type="submit" value="確認資料無誤，送出">
		<?php /*直接把sesstion資料送至DB 或再使用DB*/ ?>
	</form>
	<input type ="button" onclick="location.href='BookingPage.php?pos=<?php echo $_SESSION['pos'];?>'" value="修改"><?php/*因為返回上一頁會被擋，可能要再導向新的表單，並把舊資料傳過去*/?>
<?php
	/*
	else:
		header('location: ChoosingPage.php');
	endif;*/
?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>