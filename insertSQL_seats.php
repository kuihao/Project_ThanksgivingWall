<?php
$con=@mysqli_connect("127.0.0.1", "root", "12345", "booking") or die("NO");
mysqli_query($con,'SET NAMES utf8');
echo "connection";
$sql='';
for($i=2;$i<=15;$i++){
	$row_num=chr(ord('A')+$i/4);
	$col_num=(int)($i%4)+1;
	$pos=$row_num."-0".$col_num;
	$sql ="INSERT INTO booking_info(POS,STATUS) VALUES ('{$pos}','0')";
	$rst=@mysqli_query($con,$sql);
	if($rst){echo "OK";}else{"No";}
}
?>
