<?php
require_once './_php_library/connect.php';
require_once './_php_library/functions.php';
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

		.error {
            color: #FF0000;
        }

		form{
			width:50%;
			display:block;
		}

		.formtitle{
			width:100%;
			background-color: #CDCDEE;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>感恩牆>填寫劃位資料</title>
</head>
<body>
<?php
/*表單發送前的驗證*/

/*定義變數並設定為空值*/
$f_pos = $f_name = $f_gender = $phone_number = $f_email = $f_lineid = $f_note = $f_notedate = $f_msg = "";
$Err_name = $Err_gender = $Err_telphone = $Err_email = $Err_lineid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"):
	$f_pos = test_input($_POST["n_pos"]);
	$_SESSION['pos'] = $f_pos;
	
	if(!empty($_POST["n_name"])):
		$f_name = test_input($_POST["n_name"]);
		$_SESSION['name'] = $f_name;
	else:
		$Err_name = "姓名不能空白<br>";
	endif;

	if(!empty($_POST["n_gender"])):
		$f_gender = test_input($_POST["n_gender"]);
		$_SESSION['gender'] = $f_gender;
	else:
		$Err_gender = "請擇一選取<br>";
	endif;

	if(!empty($_POST["n_pnum"])):
		$phone_number = test_input($_POST["n_pnum"]);
		$_SESSION['phone_number'] = $phone_number;
	else:
		$Err_telphone= "電話號碼不能空白<br>";
	endif;

	if(!empty($_POST["n_email"])):
		if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST["n_email"])):
		$Err_email = "email格式無效";
		else:	
		$f_email = test_input($_POST["n_email"]);
		$_SESSION['email'] = $f_email;
		endif;
	else:
		$Err_email= "Email不能空白<br>";
	endif;

	if(!empty($_POST["n_lineid"])):
		$f_lineid = test_input($_POST["n_lineid"]);
		$_SESSION['lineid'] = $f_lineid;
	else:
		$Err_lineid= "LINE ID不能空白<br>";
	endif;

	if(!empty($_POST["n_note"])):
	$f_note = $_POST["n_note"];/*test_input($_POST["n_note"]);*/
	$_SESSION['note'] = $f_note;
	endif;

	if(!empty($_POST["n_notedate"])):
	$f_notedate = test_input($_POST["n_notedate"]);/*$_POST["n_notedate"];*/
	$_SESSION['notedate'] = $f_notedate;
	endif;

	$f_msg = test_input($_POST["n_msg"]);
	$_SESSION['msg'] = $f_msg; 
	
	if(!empty($f_pos) && !empty($f_name) && !empty($f_gender) && !empty($phone_number) && !empty($f_email) && !empty($f_lineid) 
		&& !empty($f_note) &&  !empty($f_notedate)):
	header('location: CheckingPage.php');
	endif;
endif;
?>
	<?php $pos = ($_GET['pos']);/*接收網址的pos值*/?>
	<?php if(get_status($pos)==0): ?>
	<?php
		/*此處要回傳block至DB */
	?>

		<form method="POST" action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"]))."?pos=$pos";?>">	
			<center><span class="formtitle">位置:<?php echo $pos; ?></span></center>
			<input type="hidden" id="id_pos" name="n_pos" value="<?php echo $pos; ?>">
			
			<span class="error" style="font-size:20px;">「*」是必要填寫項目<br>請勿填入特殊字符避免發生錯誤，例如:「\」</span><br>

			<span class="formtitle">*姓名:</span><br>
			<input type="text" id="id_name" name="n_name" value="<?php echo $f_name;?>"><br>
			<span class="error"> <?php echo $Err_name;?></span><br>
			
			<?php foreach($n_gender as $value):?>
				<?php switch($value){
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
			<?php endforeach;?>
			<span class="formtitle">*性別：</span><br>
			<label><input type="radio" <?php echo $rd_Male;?> id="id_gender" name="n_gender" value="Male">男</label>
			<label><input type="radio" <?php echo $rd_Female;?> id="id_gender" name="n_gender" value="Female">女</label>
			<label><input type="radio" <?php echo $rd_Other;?> id="id_gender" name="n_gender" value="Other">其他</label>
			<label><input type="radio" <?php echo $rd_Secret;?> id="id_gender" name="n_gender" value="Secret">不公開</label><br>
			<span class="error"> <?php echo $Err_gender;?></span><br>
			
			<span class="formtitle">*手機號碼:</span><br>
			<input type="text" id="id_pnum" name="n_pnum" value="<?php echo $phone_number;?>"><br>
			<span class="error"> <?php echo $Err_telphone;?></span><br>
			
			<span class="formtitle">*Email：</span><br>
			<input type="text" id="id_email" name="n_email" value="<?php echo $f_email;?>"><br>
			<span class="error"><?php echo $Err_email;?></span><br>
			
			<span class="formtitle">*Line ID:</span><br>
			<input type="text" id="id_lineid" name="n_lineid" value="<?php echo $f_lineid;?>"><br>
			<span class="error"><?php echo $Err_lineid;?></span><br>
			
			<?php foreach($f_note as $value):?>
				<?php switch($value){
				 case 'email':
					$cb_email='checked'; break;
				 case 'LINE':
					$cb_line='checked'; break;
				 case 'phonemessage':
					$cb_pmsg='checked'; break;
				 default:
					$cb_email='checked';
					$cb_line='';/*此處危險 因為是多選*/
					$cb_pmsg='';
				 }?>
			<?php endforeach;?>
			<span class="formtitle">*提醒通知方式:</span><br>
			<label><input type="checkbox" <?php echo $cb_email;?> disabled id="id_note" name="n_note[]" value="email">Email</label>
			<label><input type="checkbox" <?php echo $cb_line; ?>id="n_note" name="n_note[]" value="LINE">LINE</label>
			<label><input type="checkbox" <?php echo $cb_pmsg; ?>id="n_note" name="n_note[]" value="phonemessage">手機簡訊</label><br>

			<span class="formtitle">*活動前多少天提醒我:</span><br>
			<input type="date" id="id_notedate" name="n_notedate" value="<?php echo $f_note;?>"><br>
			
			<span class="formtitle">說你的故事或任何想法:</span><br>
			<textarea id="id_msg" name="n_msg" cols="30" rows="5" value="<?php echo $f_msg;?>"></textarea><br>
			
			<input type="submit" value="訂位">
		</form>
	<?php else: header('location: ChoosingPage.php');?>
	<?php endif;?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>