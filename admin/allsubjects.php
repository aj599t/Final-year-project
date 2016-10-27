<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Administrator Posts</title>
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

$q=mysql_query("select * from subjects order by sid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo"<tr bgcolor='#f1f1f1'><td><b>Subject Id</b></td><td><b>Subject Name </b></td><td><b>Status</b></td><td><b>Edit Subject Name</b></a></td></tr>";
while($nt=mysql_fetch_array($q)){
echo "<tr bgcolor='#f1f1f1'><td>$nt[sid]</td><td>$nt[section]</td><td>$nt[status]</td><td> <a href='subject-dtl.php?sid=$nt[sid]&f_name=subject-dtl.php?sid=$nt[sid]'>Edit</a></td></tr>";


}
echo "<tr><td><a href='subject-add.php'>Add Subject</a><td></tr>";
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
}

else
{
	if($_SESSION['userlevel']==2)
	{
		@$msg=$_GET['msg'];
		if(isset($msg) and strlen($msg) >1 ){
		echo "<span style='background-color: #FFFF00'>$msg</span>";
	}

////////////////////////////////////////////////////////////////////////////////////////////
$adminid=$_SESSION['adminid'];

$q=mysql_query("select distinct subjectid from staffsubject where adminid=$adminid");
		//$q=mysql_query("select * from subjects order by sid");
//echo "$nt".$q;
		echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
		echo"<tr bgcolor='#f1f1f1'><td><b>Subject Id</b></td><td><b>Subject Name </b></td><td><b>Status</b></td><td><b>Edit Subject Name</b></a></td></tr>";
		while($nt1=mysql_fetch_array($q))
		{
			$nt=mysql_query("select * from subjects where sid=\"$nt1[subjectid]\"");
			while($nt2=mysql_fetch_array($nt))
		{
		
			//echo "$nt2".$nt2[sid];
		echo "<tr bgcolor='#f1f1f1'><td>$nt2[sid]</td><td>$nt2[section]</td><td>$nt2[status]</td><td> <a href='subject-dtl.php?sid=$nt2[sid]&f_name=subject-dtl.php'>Edit</a></td></tr>";

		}
}
echo "<tr><td><a href='subject-add.php'>Add Subject</a><td></tr>";
echo "</table>";
	}
	else
	{
		print "<script>";
		print "self.location='demo.php'";
		print "</script>";
	}
}
?>

</body>
</html>
