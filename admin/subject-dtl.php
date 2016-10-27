<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>(Type a title for your page here)</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
<?php
include ('style.php');
?>

</head>

<body >  
<?php

require "check.php";
require "menu.php";
@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
$sid=$_GET['sid'];
$f_name=$_GET['f_name'];
$q=mysql_query("select * from subjects where sid=$sid ");
echo mysql_error();
$row=mysql_fetch_object($q);
$editable=$_GET['editable'];

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Subjectid</b>:$row->sid </td></tr>";

if($editable=="")
{
	$f_name=$f_name."?sid=".$sid;
	echo "<tr ><td colspan=2>$row->section</td></tr>";
	echo "<tr><td><a href=\"subject-dtl.php?sid=$sid&f_name=$f_name&editable=1\">Edit Subject Name</a></td></tr>";

}
else
{	
	if($editable=="1")
	{
		
	echo '<form action="subject-dtl.php" method="get">';
	echo "<input type=hidden name=sid value=$sid>";		
	echo "<input type=hidden name=f_name value='$f_name'>";
	echo "<input type=hidden name=editable value=2>";
	
	echo "<tr ><td colspan=2><textarea name=\"text1\" rows=\"20\" cols=\"100\">$row->section</textarea></td></tr>";
		
	echo "<tr><td><input type=\"submit\" /></td><td><a href=\"subject-dtl.php?sid=$sid&f_name=$f_name\">Cancel</a></td></tr>";
	echo '</form>';

	}


	else
	{	
		if($editable=="2")
		{
	
		$text1=$_GET['text1'];
		$q1=mysql_query("update  subjects set section='$text1' where sid=$sid ");
		echo mysql_error();
	
		$q=mysql_query("select * from subjects where sid=$sid ");
		echo mysql_error();
		$row=mysql_fetch_object($q);


		echo "<tr ><td colspan=2>$row->section</td></tr>";
		echo "<tr><td><a href=\"subject-dtl.php?sid=$sid&f_name=$f_name&editable=1\">Edit Subject Name</a></td></tr>";
		
}

		else
		{

		
			$q=mysql_query("select * from subjects where sid=$sid ");
			echo mysql_error();
			$row=mysql_fetch_object($q);


			echo "<tr ><td colspan=2>$row->section</td></tr>";
			echo "<tr><td><a href=\"subject-dtl.php?sid=$sid&f_name=$f_name&editable=1\">Edit Subject Name</a></td></tr>";
		

		}
	}
}
echo "</table>";
echo "<hr>";
//////////////////////////////////////////////////////////////////////////////////////////////  

//////////// Updation starts ////////////////////

switch($row->status)
{
case "lock":
$nsck="checked";
$apvck="";

break;

case "unlocked":
$apvck="checked";
$nsck="";

break;


default:
$apvck="";
$nsck="";
break;

}


echo "<form method=post action='subject-dtlck.php'><input type=hidden name='todo' value='status-up'><input type=hidden name=f_name value='$f_name'>
<input type=hidden name=sid value=".$sid.">
<input type=radio name=status value='lock' $nsck>Locked <input type=radio name=status value='unlocked' $apvck>Not Locked 
<input type=radio name=status value='del' >Delete 

<input type=submit value='Update'> 


</form>
";


///////////Updation ends ////////////////////////
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
