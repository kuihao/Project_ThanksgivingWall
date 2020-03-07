<?php
setcookie("APPLE","好好吃",time()+3600);
echo '設定APPLE';
setcookie("CANDY","sweet",time()+3600);
echo '設定CANDY';
echo '<br>';
var_dump($_COOKIE);
?>