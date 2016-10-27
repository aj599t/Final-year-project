<?php
include "session.php";
require "../config.php";
require "check.php";
?>
<?php
$theta= $_SESSION['th'];
$error= $_SESSION['se'];
$tid1=$_SESSION['id2'];

$score=($theta+41)*100/62;

mysql_query("UPDATE test SET score= '$score'  
WHERE testid = '$tid1'") or die(mysql_error()); 
//mysql_query($query);
echo "Score: ".$score;
echo "theta: ".$theta;
echo "error: ".$error;
?>