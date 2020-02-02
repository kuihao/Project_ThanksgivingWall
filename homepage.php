<?php
	include './_php_library/connect.php';
	/*SearchToDB*/
	$sql = "SELECT POS,STATUS FROM booking_info";
	$rst=@mysqli_query($con,$sql);
	if($rst){
		$count=0;$array_pos=array();$array_status=array();
		while( $row = mysqli_fetch_row($rst) ){
			++$count;
			$array_pos[$count]=$row[0];$array_stutas[$count]=$row[1];
		}
	}
	/*showbutton*/
	$bt='';
	for($i=1;$i<=$count;++$i){
		if($array_stutas[$i]==0)
			$bt=$bt."<button class=\"button allowable\">{$i}</button>";
		else if ($array_stutas[$i]==1)
			$bt=$bt."<button class=\"button forbidden\">{$i}</button>";
		if($i%4==0){$bt=$bt."<br>";}
	}
?>
<!DOCTYPE html>
<html>
	<head>
			<title>感恩牆</title>
			<meta charset="utf-8">
			<!--CSS-->
			<link rel="stylesheet" href="./_css/homepage.css" type="text/css">
	</head>
	<body>
		<div>
		<?php echo $bt;?>
		</div>
	</body>
</html>
<script></script>