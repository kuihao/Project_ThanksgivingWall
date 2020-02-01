<html>
<body>
<!- SearchToDB -->
<?php
$con=@mysqli_connect("127.0.0.1", "root", "12345", "booking") or die("NO");
mysqli_query($con,'SET NAMES utf8');

$sql = "SELECT POS,STATUS FROM booking_info";
$rst=@mysqli_query($con,$sql);
if($rst){
	$pos="";$status="";$count=0;
	while( $row = mysqli_fetch_row($rst) ){
		++$count;
		$pos=$pos.$row[0].","; $status=$status.$row[1].",";
	}
	//echo $count."^".$pos."^".$status."<br>";
}
?>
<?php
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
?>
<?php
	$gettime='';
	$gettime2='';
	$gettime3='';
	$bt='';$i=0;
	$gettime = microtime_float();
	$bt='';
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		if($i%4==0){$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3=$gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
<?php
	$gettime = microtime_float();
	$bt='';
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		if($i%4==0){$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3=$gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
<?php
	$gettime = microtime_float();
	$bt='';
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		if(($i%4)xor 1){$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3=$gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
<?php
	$gettime = microtime_float();
	$bt='';
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		if(!($i%4)){$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3=$gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
<?php
	$gettime = microtime_float();
	$bt='';
	$count2=0;
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		$count2++;
		if($count2>>2){$count2=0;$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3 = $gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
<?php
	$gettime = microtime_float();
	$bt='';
	$count2=0;
	for($i=1;$i<=$count;++$i){
		$bt=$bt."<button>{$i}</button>";
		$count2++;
		if($count2>>2){$count2&=0;$bt=$bt."<br>";}
	}
	echo $bt;
	$gettime2 = microtime_float();
	$gettime3 = $gettime2-$gettime;
	echo ($gettime3*1000);
	echo "<p>******<p>"
?>
</body>
</html>
<script>

</script>