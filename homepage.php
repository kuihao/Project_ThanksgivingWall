<html>
<body>
<!- SearchToDB -->
<?php
$con=@mysqli_connect("127.0.0.1", "root", "12345", "booking") or die("NO");
mysqli_query($con,'SET NAMES utf8');

$sql = "SELECT POS,STATUS FROM booking_info";
$rst=@mysqli_query($con,$sql);
while(  )


$rst=@mysqli_query($sql,$con);
if($rst){
	$pos="";$status="";$status="";
	while( $row = mysqli_fetch_row($rst) ){
		$ss1=$ss1.$row[0].","; $ss2=$ss2.$row[1].",";
	}
	echo $ss1."^".$ss2;
}
?>

<?php
	for($i=1;$i<=10;$i++){
		echo"<button>{$i}</button>";
	}
?>
</body>
</html>