<?php
if(!(isset($_SESSION['studentlogin']) and strlen($_SESSION['studentlogin']) > 2)){
echo "Please <a href=login.php>login</a> to use this page ";
exit;
}

?>