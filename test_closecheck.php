<?php
require_once './_php_library/connect.php';
session_destroy();
print_r($_SESSION['con']);
mysqli_close(mysqli_connect("127.0.0.1", "root", "Password123", "booking"));
?>