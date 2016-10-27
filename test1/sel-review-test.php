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
//require "menu.php";


@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";}

////////////////////////////////////////////////////////////////
echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Welcome : </b>";echo $_SESSION['studentname'] ;echo "</td></tr>";
echo "</table>";
$testid=$_GET['testid'];

$d=mysql_query("Select * from test where testid=$testid");

$ctr=1;
$qn="q".$ctr;
$an="a".$ctr;
while($dis=mysql_fetch_array($d))
{
	$s=$dis['sid'];
	while($sub=mysql_fetch_array(mysql_query("Select * from subjects where sid='$s'")))
{		$subject=$sub['section'];break;
}

	echo '<table width=100%><tr><td width=50%><b>Test ID: '.$dis['testid'].'</b><td width=50%><b>Date and Time: '.$dis['date_time'].'</b></td></tr><tr><td colspan=2><b>Subject: '.$subject.'</td></tr>';
	echo '<tr><td colspan=2><br/><b>Score:</b> '.$dis['score'].'</td></tr>';
	while(!is_null($dis[$qn]))
	{
		while($dis1=mysql_fetch_array(mysql_query("Select * from questionbank where qid=$dis[$qn]")))
		{
		echo '<tr><td colspan=2><b><br/>Question No: '.$ctr.'</b></td></tr>';
		echo '<tr><td colspan=2>'.$dis1['question'].'</td></tr>';
		echo '<tr><td colspan=2>1. '.$dis1['choice1'].'</td></tr>';
		echo '<tr><td colspan=2>2. '.$dis1['choice2'].'</td></tr>';
		echo '<tr><td colspan=2>3. '.$dis1['choice3'].'</td></tr>';
		echo '<tr><td colspan=2>4. '.$dis1['choice4'].'</td></tr>';
		echo '<tr><td colspan=2> Your answer: '.$dis[$an].'</td></tr>';
		echo '<tr><td colspan=2> Correct answer: '.$dis1['answer'].'</td></tr>';
		break;
		}
		$ctr=$ctr+1;
		$qn="q".$ctr;
		$an="a".$ctr;
		
	}
	

}
?>
