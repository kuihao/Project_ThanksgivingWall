<?php
	$count=16;
	$gettime='';
	$gettime2='';
	$gettime3='';
	$bt='';$i=0;$j=0;
	for($j=1;$j<=7;$j++){
		for($i=1;$i<=2;$i++){
			$Array[$j][$i]=0;
		}
		
	}
	
	function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
	}
	
	for($j=1;$j<=2;$j++){
	echo 'type=1<br>';
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
	$Array[1][$j]=($gettime3*1000);
	echo "<p>******<p>";

	echo 'type=1<br>';
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
	$Array[2][$j]=($gettime3*1000);
	echo "<p>******<p>";

	echo 'type=2<br>';
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
	$Array[3][$j]=($gettime3*1000);
	echo "<p>******<p>";

	echo 'type=3<br>';
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
	$Array[4][$j]=($gettime3*1000);
	echo "<p>******<p>";

	echo 'type=4<br>';
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
	$Array[5][$j]=($gettime3*1000);
	echo "<p>******<p>";

	echo 'type=5<br>';
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
	$Array[6][$j]=($gettime3*1000);
	echo "<p>******<p>";
	
	echo 'type=5<br>';
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
	$Array[7][$j]=($gettime3*1000);
	echo "<p>******<p>";
	}
	
	echo "<br>";
	for($j=1;$j<=7;$j++){
		echo (($Array[$j][1]+$Array[$j][2])/2)."<br>";
	}
?>
