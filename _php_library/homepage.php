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
	$puzzle='';
	for($i=1;$i<=$count;++$i){
		if($array_stutas[$i]==0)
			$puzzle=$puzzle."<div class=\"allowable\" style='background-color:#82FF82;'>{$i}</div>";
		else if ($array_stutas[$i]==1)
			$puzzle=$puzzle."<div class=\"forbidden\" style='background-color:#FFD382;'>{$i}</div>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<!--CSS--><link rel="stylesheet" href="./_css/homepage_setgrid.css" type="text/css">			
			<title>感恩牆</title>
	</head>
	<body>
		<div id="id_canvas" class="container grid">
			<?php echo $puzzle?>
			<!--
			<div>box 1</div>
			<div>box 2</div>
			<div>box 3</div>
			<div>box 4</div>
			-->
		</div>
	</body>
</html>
<script>
/*function TableGenerator(){
	let i,count=<?php echo $count ?>;str='';
	for(i=0;i<count;i++){str+='<div>box</div>';}
	document.getElementById('id_canvas').innerHTML=str;
}
TableGenerator();*/
</script>