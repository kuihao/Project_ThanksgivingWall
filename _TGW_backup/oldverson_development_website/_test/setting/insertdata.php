<?php
require_once '../../_php_library/connect.php';
require_once '../../_php_library/functions.php';
$x=$_GET['n_x'];
$y=$_GET["n_y"];
?>
<html>
<body>
    <?php set_block($x,$y); ?>
</body>
</html>
<?php mysqli_close($_SESSION['con']); ?>