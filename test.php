<?php
for($i=2;$i<=15;$i++){
	$row_num=chr(ord('A')+$i/4);
	$col_num=(int)($i%4)+1;
	$pos=$row_num."-0".$col_num;
	echo "{$pos}"."<br>";
}
?>