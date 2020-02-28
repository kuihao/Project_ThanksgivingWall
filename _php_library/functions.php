<?php
@session_start();

function get_status($pos){
  $data=0;
  /*--$sql是SQL操作指令--*/
  $sql = "SELECT STATUS FROM `booking_info` WHERE POS LIKE ('$pos')";
  /*--mysqli_query()執行SQL操作，select指令會回傳SQL分類結果陣列，其他指令回傳True--*/
  $rst =@mysqli_query($_SESSION['con'], $sql);
  if($rst){
    $data=mysqli_fetch_assoc($rst);/*讀取陣列資料：mysqli_fetch_assoc($rst)是以欄位名稱作為索引標籤，並回傳矩陣*/
    //print_r($rst);
    //echo '<br>';
    //print_r($data);
  }else{echo "{$sql} comes out error".mysqli_error($_SESSION['con']);}
  mysqli_free_result($rst);
  return $data['STATUS'];
}

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

/*Block means Art works, this.f() use to insert x*y blank blocks to DB */
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

/*取得單篇文章*/
function get_article($id)
{
  $result = null;
  $sql = "SELECT * FROM `article` WHERE `publish` = 1;";
  $query = mysqli_query($_SESSION['link'], $sql);
  if ($query)
  {
    if (mysqli_num_rows($query) == 1)
    {
      $result = mysqli_fetch_assoc($query);
    }
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }
  return $result;
}

/*狀態更新：占用(STATUS=-1)*/
function set_statusToblock($pos){
$sql = "UPDATE `booking_info` SET `STATUS`=-1 WHERE `POS`='$pos'";
}

function form_echo_check( $var ){
  if(!empty($_SESSION[$var]))
  return $_SESSION[$var];
}

?>