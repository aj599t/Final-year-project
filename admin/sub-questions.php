<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Questions</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
</head>
<?php
include ('style.php');
?>

<body>

<?php

require "check.php";
require "menu.php";


if($_SESSION['userlevel']==2)
{

@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}



////////////////////////////////////////////////////////////////////////////////////////////
echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Question Id</b></td><td><b>Subject id ID</b></td><td><b>Topic ID</b></td><td><b>Question</b></td><td><b>Choice 1</b></td><td><b>Choice 2</b></td><td><b>Choice 3</b></td><td><b>Choice 4</b></td><td><b>Answer</b></td><td><b>Difficulty</b></td><td><b>Date</b></td><td><b>Question Maker</b></td><td><b>Status</b></td><td><b>Detail</b></td></tr>";

$adminid=$_SESSION['adminid'];

$s=mysql_query("select subjectid from staffsubject where adminid=$adminid");

while($nt1=mysql_fetch_array($s)){
	
	$q=mysql_query("select * from questionbank where sid=\"$nt1[subjectid]\"");
//$q=mysql_query("select * from questionbank where sid=$_SESSION['adminid'] order by qid");


while($nt=mysql_fetch_array($q)){
echo "<tr bgcolor='#f1f1f1'><td>$nt[qid]</td><td> $nt[sid]</td><td>$nt[tid]</td><td>$nt[question]</td><td>$nt[choice1]</td><td>$nt[choice2]</td><td>$nt[choice3]</td><td>$nt[choice4]</td><td>$nt[answer]</td><td>$nt[difficulty]</td><td>$nt[date]</td><td>$nt[questionmaker]</td><td>$nt[status]</td><td><a href='question-dtl.php?qid=$nt[qid]&f_name=question-dtl.php?qid=$nt[qid]'>Edit</a></td></tr>";


}}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
echo "<tr><td><a href='sub-question-add.php'>Add Question</a><td></tr>";
echo "</table>";

}

else
{
print "<script>";
print "self.location='demo.php'";
print "</script>";
}
?>

</body>
</html>
