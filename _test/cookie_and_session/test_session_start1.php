<?php
session_start();
$_SESSION['TT']=100;
if($_SESSION['TT']){
    echo 'Yes';
    print_r($_SESSION['TT']);
}else{
    echo 'No'.$_SESSION['TT'];
}
echo '<br>'.session_id ();
echo '<br>';
//var_dump($_COOKIE);
print_r($_COOKIE);
?>