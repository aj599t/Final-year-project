<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Review Test</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
</head>
<?php
include ('style.php');
?>

<body>

<?php

require "check.php";

@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";}

////////////////////////////////////////////////////////////////
echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Welcome : </b>";echo $_SESSION['studentname'] ;echo "</td></tr>";
echo "</table><br/>";

echo '<fieldset>';
echo '<legend>Scores</legend>';
$uid=$_SESSION['uid'];
$sub=mysql_query("Select * from subjects") or die(mysql_error());
echo "<table width=50% align=center border=2>";
while($s=mysql_fetch_array($sub))
{
	$curr=$s['sid'];
	$t1=mysql_query("Select * from test where uid=$uid and sid=$curr order by testid") or die(mysql_error());
	$num_rows = mysql_num_rows($t1);
	if($num_rows!=0)
	{
	echo '<tr><td colspan=3 align=center><br/><b>'.$s['section'].'</b></td></tr><tr><td align=center>Test ID</td><td align=center>Date and Time</td><td align=center>Score</td></tr>';
	while($t=mysql_fetch_array($t1))
	{
		$currt=$t['testid'];
		echo "<tr><td align=center><a href='sel-review-test.php?testid=$currt'>".$t['testid']."</a></td><td align=center>".$t['date_time']."</td><td align=center>".$t['score']."</td></tr>";	
	}
	}
}
echo '</table></fieldset>';
?>
</body>
</html>