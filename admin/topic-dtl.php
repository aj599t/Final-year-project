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
include "style.php";
?>

</head>

<body >  
<?php

require "check.php";
require "menu.php";

if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{
@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}
////////////////////////////////////////////////////////////////////////////////////////////
$tid=$_GET['tid'];
$f_name=$_GET['f_name'];
$q=mysql_query("select * from topic where tid=$tid ");
echo mysql_error();
$row=mysql_fetch_object($q);
$editable=$_GET['editable'];

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Topic ID</b>:$row->tid </td></tr>";

if($editable=="")
{
	echo "<tr ><td colspan=2>$row->tname</td></tr>";
	echo "<tr><td><a href=\"topic-dtl.php?tid=$tid&f_name=$f_name&editable=1\">Edit Topic Name</a></td></tr>";

}
else
{	
	if($editable=="1")
	{
	
		
	echo '<form action="topic-dtl.php" method="get">';
	echo "<input type=hidden name=tid value=$tid>";
	echo "<input type=hidden name=f_name value=$f_name>";
	echo "<input type=hidden name=editable value=2>";
	
	echo "<tr ><td colspan=2><textarea name=\"text1\" rows=\"20\" cols=\"100\">$row->tname</textarea></td></tr>";
		
	echo "<tr><td><input type=\"submit\" /></td><td><a href=\"topic-dtl.php?tid=$tid&f_name=$f_name\">Cancel</a></td></tr>";
	echo '</form>';

	}


	else
	{	
		if($editable=="2")
		{
	
		$text1=$_GET['text1'];
		$q1=mysql_query("update  topic set tname='$text1' where tid=$tid ");
		echo mysql_error();
	
		$q=mysql_query("select * from topic where tid=$tid ");
		echo mysql_error();
		$row=mysql_fetch_object($q);


		echo "<tr ><td colspan=2>$row->tname</td></tr>";
		echo "<tr><td><a href=\"topic-dtl.php?tid=$tid&f_name=$f_name&editable=1\">Edit Topic Name</a></td></tr>";
		
}

		else
		{

		
			$q=mysql_query("select * from topic where tid=$tid ");
			echo mysql_error();
			$row=mysql_fetch_object($q);


			echo "<tr ><td colspan=2>$row->tname</td></tr>";
			echo "<tr><td><a href=\"topic-dtl.php?tid=$tid&f_name=$f_name&editable=1\">Edit Topic Name</a></td></tr>";
		

		}
	}
}
echo "</table>";
echo "<hr>";
$r=mysql_query("select * from subjects where sid=\"$row->sid\"");

$nt1=mysql_fetch_array($r);

echo '<table border="1" style="border:solid;"><tr><td>Subject ID</td><td>';echo $row->sid;
echo '</td></tr><tr><td>Subject Name</td><td>';
echo $nt1['section'];
echo'</td></tr></table>';

echo "<hr>";
$s=mysql_query("select * from subjects order by sid");

echo '<form method="post" action="subjectchange-dtlck.php">';
echo '<select name="sid1">';

while($nt2=mysql_fetch_array($s)){
if("$nt2[sid]"==$row->sid)
{
echo "<option value=$nt2[sid] selected >$nt2[section]</option>";
}
else
{
echo "<option value=$nt2[sid] >$nt2[section]</option>";
}
}
echo '</select>';
echo '<input type="hidden" name="changesubject" value="change">';
echo "<input type=hidden name=tid1 value=$row->tid>";
echo "<input type=hidden name=sid2 value=$row->sid>";
echo "<input type=hidden name=f_name value=$f_name>";
echo '<input type="submit" value="Update">';
echo '</form>';

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


echo "<form method=post action='topic-dtlck.php'><input type=hidden name='todo' value='status-up'><input type=hidden name=f_name value=$f_name>
<input type=hidden name=tid value=$tid>
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
