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
if(isset($msg) and strlen($msg) >1 )
{
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

////////////////////////////////////////////////////////////////////////////////////////////

$q=mysql_query("select * from staff order by userlevel, adminid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Admin Id</b></td><td><b>Name</b></td><td><b>UserName</b></td><td><b>UserLevel</b></td><td><b>Status</b></td><td><b>Details</b></td></tr>";
while($nt=mysql_fetch_array($q)){
echo "<tr bgcolor='#f1f1f1'><td>$nt[adminid]</td><td> $nt[name]</td><td>$nt[username]</td><td>$nt[userlevel]</td><td>$nt[status]</td><td><a href='user-dtl.php?adminid=$nt[adminid]&f_name=user-dtl.php?adminid=$nt[adminid]'>Edit</a></td></tr>";


}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
echo "<tr><td><a href='user-add.php'>Add User</a><td></tr>";
echo "</table>";

}
else
{
if($_SESSION['userlevel']==2)
{
$q=mysql_query("select * from staff order by userlevel, adminid");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr bgcolor='#f1f1f1'><td><b>Admin Id</b></td><td><b>Name</b></td><td><b>UserName</b></td><td><b>UserLevel</b></td><td><b>Status</b></td></tr>";
while($nt=mysql_fetch_array($q))
{
echo "<tr bgcolor='#f1f1f1'><td>$nt[adminid]</td><td> $nt[name]</td><td>$nt[username]</td><td>$nt[userlevel]</td><td>$nt[status]</td></tr>";
}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
//echo "<tr><td><a href='user-add.php'>Add User</a><td></tr>";
echo "</table>";

}
else
{print "<script>";
print "self.location='demo.php'";
print "</script>";
}
}

?>

</body>
</html>
