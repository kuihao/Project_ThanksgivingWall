<?php
session_start();
if(isset($_SESSION['zone']) || isset($_SESSION['pos_and_status'])){
unset($_SESSION['zone']);
unset($_SESSION['pos_and_status']);
}