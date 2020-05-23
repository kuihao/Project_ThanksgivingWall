<?php
/*(啟用session以使用php全域session變數)*/
@session_start();

/*連線至mysql管理系統中的wpdb資料庫(wpdb是存放Wordpress網站資料的資料庫)*/
$_SESSION['con']=@mysqli_connect("127.0.0.1", "root", "", "wpdb") or die("NO");
if($_SESSION['con']){mysqli_query($_SESSION['con'], "SET NAMES utf8");}
else{echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();}

/*=================== My functions ===========================*/
/*
**  函式名稱：get_status($pos)
**  [用途：查詢位置是否許可]
**  輸入: 畫布區塊的位置編號(String)...例如查詢單筆:'A-01' 或 查詢多筆:'A'
**  回傳: 位置的狀態(True/ False)...True表示空位(允許)/ False表示已有登記(禁止)或正在被報名(鎖定)
**  程式要點： 資料庫會回傳時間字串，用時間來判斷此位置的狀態為何
**          (1)time=2222/1/1 00:00:00，(設定為100年後)表示此位置已被登記->False
**          (2)time>現在時間，表示此位置正在被報名->False
**          (3)time<現在時間，表示此位置是空位->True
*/
function get_status($pos){
  /*--資料庫搜尋--*/
      /*$array_DB_return用來接收含有回傳的time資料*/
      $array_DB_return = array();

      /*$sql是SQL操作指令*/
      $sql = "SELECT STATUS FROM `booking_info` WHERE POS LIKE ('$pos%')";
      /*mysqli_query()執行SQL操作，select指令會回傳SQL分類結果陣列，其他指令回傳True*/
      $rst =@mysqli_query($_SESSION['con'], $sql);
      if($rst){
        /*mysqli_num_rows($rst)回傳result矩陣的列數量*/
        if(mysqli_num_rows($rst) > 0){ 
          /*讀取陣列資料：mysqli_fetch_assoc($rst)是以欄位名稱作為索引標籤，並回傳矩陣*/
          for($i = 0; $row= mysqli_fetch_assoc($rst); $i++){
            $array_DB_return[] = $row;
            /*判斷該位置紀錄的時間 是否小於 當前時間*/
            if( strtotime($array_DB_return[$i]['STATUS']) < strtotime(date("Y-m-d H:i:s")) ){
              /*在$array_DB_return[$i]後面push一個node[permit]，用來記錄允許與否*/
              $array_DB_return[$i] += [ "permit" => True];
            }else{
              $array_DB_return[$i] += [ "permit" => False];             
            }
          }
        }
        mysqli_free_result($rst);
      }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
      // echo "(Debug) *count:* ".count($array_DB_return)."<br>";
      // echo "(Debug) *print_r:* ";print_r($array_DB_return);echo "<br>";

  /*回傳資料*/
  if($i < 2){
    return $array_DB_return[0]['permit'];/*單筆資料搜索值接回傳字串*/
  }else{
    return $array_DB_return;/*多筆資料搜索回傳陣列型態*/
  }
}

/*------------------old fun following--------------------*/
/*連線至TGW資料庫(目前是連至bookingDB)*/
$_SESSION['con']=@mysqli_connect("127.0.0.1", "root", "", "booking") or die("NO");
if($_SESSION['con']){mysqli_query($_SESSION['con'], "SET NAMES utf8");}
else{echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();}

/*(可選擇的指令)讓網頁前端隱藏wordpress meta資料*/
remove_action('wp_head', 'wp_generator');

/*(可選擇的指令)客製化控制台訊息框*/
function TGW_dashboard_widgets(){
    global $wp_meta_boxes;
    wp_add_dashboard_widget('TGW_help_widget',"來自網頁開發者的提醒",'TGW_dashboard_help');
}
function TGW_dashboard_help(){
    echo '<p><b>To whom it may concern:</b></p>
    <p>若您是一般網頁管理者：Wordpress是一個毋需網頁程式語言能力亦可輕鬆調整網頁介面的開發框架，
    你可以自動略過任何有關程式碼的部分，透過左邊選單中的Elementor插件功能即可隨心所欲、安全地編輯網頁。</p>
    <p>若您是程式設計師：由於wordpress(以下簡稱WP)是整合框架，請善用WP所提供完善的API進行一切程式碼的編修，。
    為了保護程式重要資料，<b>建議勿直接修改WP資料夾</b>內部檔案的程式碼，
    例如直接修改主題(Theme/tamplate)的程式碼，若此主題的原開發者推出更新版本，可能導致的自定義的程式碼被洗掉。</p>
    <p>因此若需要自定義任何程式碼(html, Javascript, CSS, php)有以下幾種方式：</p>
    <p>(1)任何頁面的物件都具備<b>自定義CSS(Additional CSS class)</b>、<b>html修改</b>(Edit as html)</p>
    <p>(2)若需要全域套用CSS：點選做側欄->外觀->自訂->附加的CSS，此處可以針對整個模板做CSS調整</p>
    <p>(3)任何你看到可以編寫html語法的地方都可以編寫javascript</p>
    <p>(4)若想引入自己撰寫的php page(參雜php語法及html語法的檔案)，可以透過外掛插件<b>Insert PHP Code Snippet</b>，
    該插件允許編寫php檔案，你可以將html語法用echo回傳，最後儲存後你會得到一段中誇號短語法，你可以在頁面加入shortcode物件，並貼上該語法，就能達到嵌入php page的效果</p>
    <p>(5)若想新增自製的php library，可以使用插件<b>我的自訂功能(my custom functions)</b>此處撰寫的php function或執行的method都會直接反映在網頁上</p>
    <p><b>目前使用的外掛插件有Elementor(比WP原生的編輯器更佳、易上手的GUI編輯器)、Insert PHP Code Snippet、my custom functions</b></p>
    <p>若操作上任何疑問，請洽東華大學社參辦(XXXXXXXX)</p>
    <p>上位網頁開發者：Kuihao(41053A041@gms.ndhu.edu.tw)</p>';
}
add_action('wp_dashboard_setup','TGW_dashboard_widgets');

/*(需要connection/session)輸入畫布位置、資料庫回傳位置的狀態(允許、禁止、鎖定)*/
function get_status($pos){
  $data=0;
  /*--$sql是SQL操作指令--*/
  $sql = "SELECT STATUS FROM `booking_info` WHERE POS LIKE ('$pos')";
  /*--mysqli_query()執行SQL操作，select指令會回傳SQL分類結果陣列，其他指令回傳True--*/
  $rst =@mysqli_query($_SESSION['con'], $sql);

  if($rst){
    $data=mysqli_fetch_assoc($rst);
    //print_r($rst);
    //echo '<br>';
    //print_r($data);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  mysqli_free_result($rst);
  return $data['STATUS'];
}

/*(需要connection/session)輸入區碼、資料庫回傳狀態、位置*/
/*get the position and status of blocks. status:0=empty,1=occupied,-1=temprary lock*/
function get_position_and_status($zone){
  $datas = array();
  $sql = "SELECT POS,STATUS FROM `booking_info` WHERE POS LIKE ('$zone%')";
  $rst =@mysqli_query($_SESSION['con'], $sql);

  if($rst){
    if(mysqli_num_rows($rst) > 0){ /*mysqli_num_rows($rst)回傳result矩陣的列數量*/
      while ($row = mysqli_fetch_assoc($rst)){ 
        $datas[] = $row;
      }
    }
    mysqli_free_result($rst);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  //$_SESSION['count']=count($datas);
  //echo $_SESSION['count'];
  //print_r($datas);
  return $datas;
}

/*(需要connection/session)位置初始化：為資料庫新增x*y筆位置資料 Block means Art works, this.f() use to insert x*y blank blocks to DB */
function set_block($x, $y)
{
	$sql='';
	for($i=0;$i<$x;$i++){
		$pos_row=chr(ord('A')+$i);
		for($j=1;$j<=$y;$j++){
      if($j<=9):
        $pos_col='0'.$j;
      else:
        $pos_col=$j;
      endif;
      $pos=$pos_row."-".$pos_col;

    	$sql ="INSERT INTO booking_info(POS,STATUS) VALUES ('{$pos}','0')";
      echo "{$pos}.OK<br>";
			$rst=@mysqli_query($_SESSION['con'],$sql);
    	if($rst){echo "{$pos}.OK";}else{"{$pos}.fail";}
		}
	}
}

/*(需要connection/session)狀態更新：占用(STATUS=-1)*/
/*位置正在被選取，將資料庫位置狀態設為-1*/
function edit_statusToblock($pos){
$sql = "UPDATE `booking_info` SET `STATUS`=-1 WHERE `POS`='$pos'";
}

/*這有問題 防止表單重複提交機制要更動*/
function form_echo_check( $var ){
  if(!empty($_SESSION[$var]))
  return $_SESSION[$var];
}

/*(需要connection/session)用於首頁，計算該區域有多少空位可以使用*/
function count_status($zone){
  $sql = "SELECT `STATUS` FROM `booking_info` WHERE POS LIKE ('$zone%')";
  $rst =@mysqli_query($_SESSION['con'], $sql);
  
  $count=0;/*計算空位的數量*/
  
  if($rst){
    if(mysqli_num_rows($rst) > 0){ /*mysqli_num_rows($rst)回傳result矩陣的列數量*/
      
      while ($one_row = mysqli_fetch_assoc($rst)){ 
        if($one_row['STATUS']==0)$count++;/*若狀態為0表示是空位，conut+1*/
      }
    }
    mysqli_free_result($rst);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}

  return $count;
}

/*表單驗證之用，防止使用者特殊輸入*/
function test_input($data) {
  if( is_array($data)){
    foreach($data as $key => $value){
      $value = trim($value);/*去除用户输入数据中不必要的字符（多余的空格、制表符、换行）*/
      $value = htmlspecialchars($value);/*轉換HTML標籤語法*/
      $value = stripslashes($value);/*删除用户输入数据中的反斜杠（\）*/
      $data[$key] = $value;
    }
  }else{
    $data = trim($data);/*去除用户输入数据中不必要的字符（多余的空格、制表符、换行）*/
    $data = stripslashes($data);/*删除用户输入数据中的反斜杠（\）*/
    $data = htmlspecialchars($data);/*轉換HTML標籤語法*/
  }

	return $data;
 }

/*用於表單性別*/
function table_gender($data){
  $word="";
  switch($data){
    case 'Male':
      $word = '男';
      break;
    case 'Female':
      $word = '女';
      break;
    case 'Other':
      $word = '其他';  
      break;
    case 'Secret':
      $word = '不公開';
      break;
    default:
      $word = '存取錯誤';
  }
  return $word;
}

/*用於表單提醒方式*/
function table_note($datas){
  $word="";
  foreach($datas as $onedata)
  switch($onedata){
    case 'email':
      $word = $word.'Email ';
      break;
    case 'LINE':
      $word = $word.'LINE ';
      break;
    case 'phonemessage':
      $word = $word.'手機簡訊 ';  
      break;
    default:
      $word = '存取錯誤';
  }
  return $word;
}

/*測試php server, 成功會回傳雙引號及單引號的特性*/
function K_testing(){
    $test_var=100;
    echo "Double quotes: $test_var<br>";
    echo 'Apostrophe: $test_var';
}

/*測試mysql+php server, 成功會回傳資料庫中流水號為1的位置資料*/
function DB_testing(){
  /*--data裝DB回傳資料--*/
  $data=0;
  /*--$sql存欲操作DB的SQL操作指令(現行官方用語叫query)--*/
  $sql = "SELECT `POS` FROM `booking_info` WHERE SER = '1'";
  /*--mysqli_query()執行傳入的SQL指令，回傳SQL分類結果陣列，其他指令回傳True--*/
  $rst =@mysqli_query($_SESSION['con'], $sql);
  if($rst){
    $data=mysqli_fetch_assoc($rst);/*讀取陣列資料：mysqli_fetch_assoc($rst)是以欄位名稱作為索引標籤，並回傳矩陣*/
    print_r($rst);
    echo '<br>';
    print_r($data);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  mysqli_free_result($rst);
  return $data['POS'];
}



?>