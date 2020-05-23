<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_SESSION['a'])){
    echo $_SESSION['a']."<br>";
}else{
    $_SESSION['a']="Hello";
    echo $_SESSION['a']."<br>";
}

$_SESSION['lalamove'] = "lol";
echo $_SESSION['lalamove'];
?>
123456
</body>
</html>