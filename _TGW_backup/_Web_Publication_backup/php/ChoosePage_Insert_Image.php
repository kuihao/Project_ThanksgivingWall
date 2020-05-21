<?php
session_start();
if(isset($_SESSION['zone'])){
$src = "src=\"http://127.0.0.1/wp-content/uploads/2020/05/test_breakfast_part_".$_SESSION['zone'].".jpg\" ";
echo "<img class=\"img_Property\" ".$src." alt=\" This is a painting picture.\">";
}