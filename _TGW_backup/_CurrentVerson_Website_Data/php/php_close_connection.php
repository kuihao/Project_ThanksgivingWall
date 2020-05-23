<?php
session_start();
mysqli_close($_SESSION['con']);
unset($_SESSION['con']);