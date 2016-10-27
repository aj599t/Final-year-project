<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>All Topics</title>
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
$adminid=$_SESSION['adminid'];
$s1=mysql_query("select * from staffsubject where adminid=$adminid");


//$q=mysql_query("select * from topic order by tid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo"<tr bgcolor='#f1f1f1'><td><b>Topic Id</b></td><td><b>Topic Name </b></td><td><b>Status</b></td><td><b>Edit Topic Name</b></a></td><td><b>Subject Id</b></td><td><b>Subject Name</b></a></td></tr>";
while($re1=mysql_fetch_array($s1))
		{
		$s2=mysql_query("select * from subjects where sid=$re1[subjectid]");
		while($re2=mysql_fetch_array($s2))
		{
		$t=mysql_query("select * from topic where sid=$re1[subjectid]");
		while($nt3=mysql_fetch_array($t))
		{
		echo "<tr bgcolor='#f1f1f1'><td>$nt3[tid]</td><td>$nt3[tname]</td><td>$nt3[status]</td><td> <a href='topic-dtl.php?tid=$nt3[tid]&f_name=topic-dtl.php?tid=$nt3[tid]'>Edit</a></td><td>$nt3[sid]</td><td>$re2[section]</td></tr>";

		}	
		}
		}	



echo "<tr><td><a href='sub-topic-add.php'>Add Topic</a><td></tr>";
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
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
