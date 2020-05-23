<?php
/* session已於snippet:php_connection全域啟動，此處毋需再啟用 */// session_start();

if(isset($_SESSION['positions']) || isset($_SESSION['pos_and_status'])){
unset($_SESSION['zone']);
unset($_SESSION['positions']);
}