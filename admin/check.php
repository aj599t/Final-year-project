<?php
if(!(isset($_SESSION['userid']) and strlen($_SESSION['userid']) > 2)){
echo "Please <a href=index.php>login</a> to use this page ";
exit;
}

?>