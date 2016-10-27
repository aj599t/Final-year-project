<?php
require "config.php";
?>
<?php
$sid=$_POST['sid'];
$str1="select * from topic where sid=".$sid;
$st=mysql_query($str1);
while($t=mysql_fetch_array($st))
{
	$str="update topic set dq=".$_POST[$t['tid']]." where tid=".$t['tid'];
	mysql_query($str);
	header("Location: test/test.php");	
}
?>
