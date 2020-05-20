<?php
session_start();
/*** 刪除所有的session變數..也可用unset($_SESSION[xxx])逐個刪除。****/
$_SESSION = array();
/***刪除sessin id.由於session預設是基於cookie的，所以使用setcookie刪除包含session id的cookie.***/
if (isset($_COOKIE[session_name()])) {
setcookie(session_name(), '', time()-42000, '/');
}
// 最後徹底銷燬session.
session_destroy();
?>