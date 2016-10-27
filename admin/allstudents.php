<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>All Studends</title>
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
if(isset($msg) and strlen($msg) >1 )
{
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

////////////////////////////////////////////////////////////////////////////////////////////

$q=mysql_query("select * from students order by uid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Student Id</b></td><td><b>Student Login</b></td><td><b>Email ID</b></td><td><b>Contact</b></td><td><b>Address</b></td><td><b>date</b></td><td><b>StudentName</b></td><td><b>Status</b></td><td><b>Detail</b></td></tr>";
while($nt=mysql_fetch_array($q))
{
echo "<tr bgcolor='#f1f1f1'><td>$nt[uid]</td><td> $nt[studentlogin]</td><td>$nt[email_id]</td><td>$nt[contact]</td><td>$nt[address]</td><td>$nt[date]</td><td>$nt[studentname]</td><td>$nt[status]</td><td><a href='user-dtl.php?adminid=$nt[adminid]&f_name=user-dtl.php?adminid=$nt[adminid]'>Edit</a></td></tr>";


}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
//echo "<tr><td><a href='student-add.php'>Add Student</a><td></tr>";
echo "</table>";


}
else
{
	if($_SESSION['userlevel']==2)
	{
		
@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 )
{
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

////////////////////////////////////////////////////////////////////////////////////////////

$q=mysql_query("select * from students order by uid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Student Id</b></td><td><b>Student Login</b></td><td><b>Email ID</b></td><td><b>Contact</b></td><td><b>Address</b></td><td><b>date</b></td><td><b>StudentName</b></td><td><b>Status</b></td></tr>";
while($nt=mysql_fetch_array($q))
{
echo "<tr bgcolor='#f1f1f1'><td>$nt[uid]</td><td> $nt[studentlogin]</td><td>$nt[email_id]</td><td>$nt[contact]</td><td>$nt[address]</td><td>$nt[date]</td><td>$nt[studentname]</td><td>$nt[status]</td></tr>";


}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
//echo "<tr><td><a href='student-add.php'>Add Student</a><td></tr>";
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
