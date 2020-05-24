<?php
/*(啟用session以使用php全域session變數)*/
@session_start();

/*=================== Highlight(變數解釋) =====================*/
/*  
 * 區碼編號：$zone，由英文字母A-Z所構成的字串
 * 位置編號：$pos，由"$zone-digits"所構成的字串，例如: A-01
 * 畫布目前設為兩層的結構，共有16x16=256個區塊可供選擇，
 * 第一層用英文字母分區，第二層依區碼顯示完整的位置編號，
 * 此設計是參考目前商業界演唱會訂位系統的設計所製作，可保證使用者體驗佳
*/
/*=================== My functions ===========================*/
/*
**  函式名稱：get_status_permition($pos)
**  [用途：查詢位置是否許可]
**  輸入: 畫布區塊的位置編號(String)...例如查詢單筆:'A-01' 或 查詢多筆:'A'
**  回傳: 位置的狀態(integer)...1表示空位(允許)/ -1表示已有登記(禁止)/ 0正在被報名(鎖定)
**  程式要點： 資料庫會回傳時間字串，用時間來判斷此位置的狀態為何
**          (1)time=2222/1/1 00:00:00，(設定為100年後)表示此位置已被登記-> -1
**          (2)time>現在時間，表示此位置正在被報名-> 0
**          (3)time<現在時間，表示此位置是空位-> 1
*/
function get_status_permition($pos){
  /*校正時間*/
  date_default_timezone_set("Asia/Taipei");

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
        /*判斷該位置紀錄的時間 與 當前時間的關係*/
        if( strtotime($array_DB_return[$i]['STATUS']) == strtotime("2222-01-01 00:00:00") ){
          /*等於永久時間表示位置已被登記，permit設為-1，永不可到達之意*/
          $array_DB_return[$i] += [ "permit" => -1];
        }elseif( strtotime($array_DB_return[$i]['STATUS']) > strtotime(date("Y-m-d H:i:s")) ){
          /*大於當前時間表示位置正在被選取，permit設為0*/
          $array_DB_return[$i] += [ "permit" => 0];   
        }else{
          /*根據三一律，小於當前時間表示位置是空位，可以被報名登記，permit設為1*/
          $array_DB_return[$i] += [ "permit" => 1];
        }
      }
    }
    mysqli_free_result($rst);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  // echo "(Debug) *count:* ".count($array_DB_return)."<br>";
  // echo "(Debug) *print_r:* ";print_r($array_DB_return);echo "<br>";

  /*--回傳資料--*/
  if($i < 2){
    return $array_DB_return[0]['permit'];/*單筆資料搜索值接回傳字串*/
  }else{
    return $array_DB_return;/*多筆資料搜索回傳陣列型態，需要自行拆解*/
  }
}

/*get_position_and_status
**  函式名稱：get_position($zone)
**  [用途：查詢該分區中所有的位置編號]
**  輸入: 畫布區塊的區碼編號(String)...例如'A'
**  回傳: 所有位置編號的二維陣列(Array)
**  程式要點：個別資料存於array[index][POS]，另一端接收資料後要用foreach拆解
*/
function get_position($zone){
  $datas = array();
  $sql = "SELECT POS FROM `booking_info` WHERE POS LIKE ('$zone%')";
  $rst =@mysqli_query($_SESSION['con'], $sql);

  if($rst){
    if(mysqli_num_rows($rst) > 0){ /*mysqli_num_rows($rst)回傳result矩陣的列數量*/
      while ($row = mysqli_fetch_assoc($rst)){ 
        $datas[] = $row;
      }
    }
    mysqli_free_result($rst);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  //echo "(Debug) ";print_r($datas);echo "<br>";
  return $datas;
}

/**edit_statusToblock
 * 函式名稱：set_status_blocking($pos, $addMinute)
 * [用途：當使用者進入填寫表單頁面，要將該位置設為"鎖定"，因為報名過程中要防止其他人Overbooking]
 * 輸入:$pos位置編號、$addMinute要暫時鎖定多少分鐘
 * 回傳:無
 * 程式要點：此設計的優點是若時間到要解除鎖定，毋須再更新資料庫，
 *          隨著世界運轉，封鎖會自動過期，只要搭配get_status_permition()更新前端的
 *          顯示狀態即可。同樣道理若將時間設為一個生命無法到達的時間，相當於永久封鎖。
 */
function set_status_blocking($pos, $addMinute){
  $blockingTime = new datetime();
  $addTime = 'P0Y0M0DT0H'."$addMinute".'M0S';
  $blockingTime->add(new DateInterval($addTime));
  $StringOfTime = $blockingTime->format("Y-m-d H:i:s");
  $sql = "UPDATE `booking_info` SET `STATUS`= '$StringOfTime' WHERE `POS`='$pos'";
  $rst=@mysqli_query($_SESSION['con'], $sql);
}

/**count_status()
 * 函式名稱：get_status_permition_count($zone)
 * [用途：目前用於首頁畫面，計算每個區有尚有多少個空位]
 * 輸入:$zone 區域編碼(string)
 * 回傳:$count 數量(int or string?)
 * 程式要點：盡量在資料庫搜尋時就先過篩，減少傳遞的資料size，加快後台資料處理速度
 */
function get_status_permition_count($zone){
  /*根據位置區碼，搜尋資料庫小於目前時間的資料，並回傳其數量(陣列形式)*/
  $sql = "SELECT COUNT(`SER`) FROM `booking_info` WHERE `POS` LIKE '$zone%' AND `STATUS`<CURRENT_TIMESTAMP ";
  $result  =@mysqli_query($_SESSION['con'], $sql);
  if($result){
    if(mysqli_num_rows($result) > 0){ /*function mysqli_num_rows($result)回傳result矩陣的列數量*/
      $count = mysqli_fetch_assoc($result);
    }
    mysqli_free_result($result );
  }else{echo "{$sql} comes out error!!<br>".mysqli_error($_SESSION['con']);}

  return $count['COUNT(`SER`)'];
}

/**
 * (選擇性的功能)
 * [用途：客製化後端控制台的訊息框]
 * 程式要點：直接編寫HTML即可，比對一下控制台的畫面，this is not too difficult to understand.
*/
// function TGW_dashboard_widgets(){
//   global $wp_meta_boxes;
//   wp_add_dashboard_widget('TGW_help_widget',"來自網頁開發者的提醒",'TGW_dashboard_help');
// }
// function TGW_dashboard_help(){
//   echo '<p><b>To whom it may concern:</b></p>
//   <p>若您是一般網頁管理者：Wordpress是一個毋需網頁程式語言能力亦可輕鬆調整網頁介面的開發框架，
//   你可以自動略過任何有關程式碼的部分，透過左邊選單中的Elementor插件功能即可隨心所欲、安全地編輯網頁。</p>
//   <p>若您是程式設計師：由於wordpress(以下簡稱WP)是整合框架，請善用WP所提供完善的API進行一切程式碼的編修，。
//   為了保護程式重要資料，<b>建議勿直接修改WP資料夾</b>內部檔案的程式碼，
//   例如直接修改主題(Theme/tamplate)的程式碼，若此主題的原開發者推出更新版本，可能導致的自定義的程式碼被洗掉。</p>
//   <p>因此若需要自定義任何程式碼(html, Javascript, CSS, php)有以下幾種方式：</p>
//   <p>(1)任何頁面的物件都具備<b>自定義CSS(Additional CSS class)</b>、<b>html修改</b>(Edit as html)</p>
//   <p>(2)若需要全域套用CSS：點選做側欄->外觀->自訂->附加的CSS，此處可以針對整個模板做CSS調整</p>
//   <p>(3)任何你看到可以編寫html語法的地方都可以編寫javascript</p>
//   <p>(4)若想引入自己撰寫的php page(參雜php語法及html語法的檔案)，可以透過外掛插件<b>Insert PHP Code Snippet</b>，
//   該插件允許編寫php檔案，你可以將html語法用echo回傳，最後儲存後你會得到一段中誇號短語法，你可以在頁面加入shortcode物件，並貼上該語法，就能達到嵌入php page的效果</p>
//   <p>(5)若想新增自製的php library，可以使用插件<b>我的自訂功能(my custom functions)</b>此處撰寫的php function或執行的method都會直接反映在網頁上</p>
//   <p><b>目前使用的外掛插件有Elementor(比WP原生的編輯器更佳、易上手的GUI編輯器)、Insert PHP Code Snippet、my custom functions</b></p>
//   <p>若操作上任何疑問，請洽東華大學社參辦(XXXXXXXX)</p>
//   <p>上位網頁開發者：Kuihao(41053A041@gms.ndhu.edu.tw)</p>
//   <p><em>若想更改此段訊息，請於左欄點選Woody snippets，找尋並編輯"my_php_function"，
//   最後搜尋function TGW_dashboard_help()即可編輯這段文字</em></p>';
// }
// add_action('wp_dashboard_setup','TGW_dashboard_widgets');

/**
 * 函式名稱：set_block($x, $y)
 * [用途：為資料庫新增x*y筆初始化位置資料，用於開設新的畫布頁面或重設資料庫時，可能用得上]
 * 輸入:$x、$y...x*y即完全平方數，例如：256筆資料是16*16、36筆資料是6*6
 * 回傳:無
 * 程式要點：注意!!x、y不是列*欄，第一個變數會轉成英文字母
 */
// function set_block($x, $y)
// {
// 	$sql='';
// 	for($i=0;$i<$x;$i++){
// 		$pos_row=chr(ord('A')+$i);
// 		for($j=1;$j<=$y;$j++){
//       if($j<=9):
//         $pos_col='0'.$j;
//       else:
//         $pos_col=$j;
//       endif;
//       $pos=$pos_row."-".$pos_col;

//     	$sql ="INSERT INTO booking_info(POS,STATUS) VALUES ('{$pos}','0')";
//       echo "{$pos}.OK<br>";
// 			$rst=@mysqli_query($_SESSION['con'],$sql);
//     	if($rst){echo "{$pos}.OK";}else{"{$pos}.fail";}
// 		}
// 	}
// }

/**
 * 更新日期：2020/05/23 連接新資料庫、優化SQL搜尋、
 *                     降低函式的耦合性(Coupling)、大幅提高內聚性(Cohesion)、
 *                     新增WP風格的註解
 */
?>