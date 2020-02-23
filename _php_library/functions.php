<?php
@session_start();

/*get the position and status of blocks. status:0=empty,1=occupied,-1=temprary lock*/
function get_position_status(){
  $datas = array();
  $sql = "SELECT `POS`,`STATUS` FROM `booking_info`";
  $rst =@mysqli_query($_SESSION['con'], $sql);

  if($rst){
    if(mysqli_num_rows($rst) > 0){
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
		for($j=0;$j<$y;$j++){
			$pos_col=$j+1;
			$pos=$pos_row."-".$pos_col;
			$sql ="INSERT INTO booking_info(POS,STATUS) VALUES ('{$pos}','0')";
			//echo "{$pos}.OK<br>";
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
?>