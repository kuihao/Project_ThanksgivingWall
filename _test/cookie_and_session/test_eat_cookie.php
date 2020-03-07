<?php
echo 'Eat cookie XD<br>';
setcookie("PHPSESSID","",time()-3600);
echo '<br><<測試看看此刻的cookie>><br>';
if(!empty($_COOKIE)){
    echo '有cookie:';
    print_r($_COOKIE);
}
else{
    echo '無cookie:';
    print_r($_COOKIE);
}
