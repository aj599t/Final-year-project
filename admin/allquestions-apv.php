<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>All Questions</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
</head>
<?php
include ('style.php');
?>

<body>

<?php

require "check.php";
require "menu.php";


if($_SESSION['userlevel']==1)
{

@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

////////////////////////////////////////////////////////////////////////////////////////////

$q=mysql_query("select * from questionbank where status='apv' order by qid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Question Id</b></td><td><b>Student ID</b></td><td><b>Topic ID</b></td><td><b>Question</b></td><td><b>Choice 1</b></td><td><b>Choice 2</b></td><td><b>Choice 3</b></td><td><b>Choice 4</b></td><td><b>Answer</b></td><td><b>Difficulty</b></td><td><b>Date</b></td><td><b>Question Maker</b></td><td><b>Status</b></td><td><b>Detail</b></td></tr>";
while($nt=mysql_fetch_array($q)){
echo "<tr bgcolor='#f1f1f1'><td>$nt[qid]</td><td> $nt[sid]</td><td>$nt[tid]</td><td>$nt[question]</td><td>$nt[choice1]</td><td>$nt[choice2]</td><td>$nt[choice3]</td><td>$nt[choice4]</td><td>$nt[answer]</td><td>$nt[difficulty]</td><td>$nt[date]</td><td>$nt[questionmaker]</td><td>$nt[status]</td><td><a href='user-dtl.php?adminid=$nt[adminid]&f_name=user-dtl.php?adminid=$nt[adminid]'>Edit</a></td></tr>";


}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
echo "<tr><td><a href='student-add.php'>Add Student</a><td></tr>";
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
