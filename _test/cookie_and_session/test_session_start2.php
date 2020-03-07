<?php
session_start();
echo '啟用SESSION(若此次瀏覽cookie紀錄中已存在[PHPSESSID]則使用該筆SESSION:否則cookie產生新[PHPSESSID])<br>';
//$_SESSION['TT']=200;
/*
if($_SESSION['TT']){
    echo 'Yes';
    print_r($_SESSION['TT']);
}else{
    echo 'No'.$_SESSION['TT'];
}
echo '<br>'.session_id ();
echo '<br>';*/
var_dump($_COOKIE);
?>