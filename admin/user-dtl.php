<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>User Detail</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
<?php
include ('style.php');
?>
</head>

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

echo '
<script type="text/javascript">

function something()
{
document.getElementById(\'error1\').style.display="none";
if(document.passwordreset.pass.value.length<6)
{
document.getElementById(\'error1\').style.display="";
return false;
}
return true;
}

</script> ';




////////////////////////////////////////////////////////////////////////////////////////////
$adminid=$_GET['adminid'];
$adminid1=$_GET['adminid'];
$f_name=$_GET['f_name'];
$q=mysql_query("select * from staff where adminid=$adminid ");
echo mysql_error();
$row=mysql_fetch_object($q);
$userlevel=$row->userlevel;
$l=mysql_query("select * from userlevel where userlevel=$userlevel");
echo mysql_error();
$row1=mysql_fetch_object($l);
$editable=$_GET['editable'];
$remove=$_GET['remove'];

//echo $f_name;
echo '<fieldset><legend>Personal Details</legend>';



echo "<table  border='2' cellspacing='1' cellpadding='5' >";
echo "<tr  bgcolor='#f1f1f1' ><td><b>Admin Id </b></td><td>$row->adminid</td></tr>";

	echo "<tr ><td><b>Name</b></td><td> $row->name</td></tr>";
	echo "<tr ><td><b>Username</b></td><td> $row->username</td></tr>";
	echo "<tr ><td><b>UserLevel</b></td><td> $row1->levelname</td></tr>";
	echo "<tr><td colspan=2><a href='user-changedetails.php?f_name=$f_name&adminid1=$adminid1&levelname=$row1->levelname&editable=3'>Edit Details</a></td></tr>";

echo "</table></fieldset>";

//////////////////////////////////////////////////////////////////////////////////////////////  
if($remove==1)
{
$subjectid=$_GET['subjectid'];
$z=mysql_query("delete  from staffsubject where subjectid=$subjectid AND adminid=$adminid ");
echo mysql_error();

}
$r=mysql_query("select subjectid from staffsubject where adminid=$adminid ");
echo mysql_error();


echo '<fieldset><legend>Subject Details</legend>';



echo "<table  border='2' cellspacing='1' cellpadding='5' >";
echo "<tr bgcolor='#f1f1f1'><td><b>Subject Id </b></td><td><b>Subject Name</b></td><td><b>Action</b></td></tr>";

while($row1=mysql_fetch_array($r)){
$s=mysql_query("select * from subjects where sid=$row1[subjectid] ");
echo mysql_error();
$row2=mysql_fetch_array($s);

echo "<tr><td>$row1[subjectid]</td><td>$row2[section]</td><td><a href='$f_name&f_name=$f_name&remove=1&subjectid=$row1[subjectid]'>Remove</a></td><tr>";
}
if($editable=="")
{
echo "<tr><td colspan=3 align=center><a href='$f_name&f_name=$f_name&editable=1'>Assign New Subject</a></td></tr>";
}
echo "</table>";
if($editable=="1")
{ 
echo "<br />";
		
	echo '<form action="user-dtl.php" method="get">';
	echo "<input type=hidden name=adminid value=$adminid>";
	echo "<input type=hidden name=f_name value='$f_name'>";
	echo "<input type=hidden name=editable value=2>";

	
	echo "<b>Select Subject : </b>";
	echo "<select name=newsubject>";
	$s=mysql_query("select * from subjects order by sid");
	while($nt2=mysql_fetch_array($s)){
		
		$flag=0;
		$z=mysql_query("select subjectid from staffsubject where adminid=$adminid ");

		while($row1=mysql_fetch_array($z)){
			if($row1[subjectid]=="$nt2[sid]")
			{
			
				$flag=1;
			}
			else
			{
				
			}
		}	
		

		if($flag==0)
		{
		echo "<option value=$nt2[sid] >$nt2[section]</option>";
		}
		
	}

	echo "</select>"; 
	echo "&nbsp;<input type=submit value=Select>";

	echo "&nbsp;<a href=$f_name&f_name=$f_name>Cancel</a>";
	echo "</form>";
}
else
{
if($editable=="2")
{
	$newsubject=$_GET['newsubject'];
	$q1=mysql_query("insert into staffsubject(adminid,subjectid) values ($adminid,$newsubject) ");
	echo mysql_error();
	echo '<script>window.location="';echo $f_name;echo'&f_name=';echo $f_name;echo'";</script>';
}

}
echo"</fieldset>";

//////////////////////////////////////////////////////////////////////////////////////////////  
echo '<fieldset><legend>Reset Password</legend>';
echo "<form method=post action=passwordreset-ck.php name=passwordreset onsubmit=\"return something();\"><input type=hidden name=todo value=passwordreset><input type=hidden name=f_name value=$f_name>
<input type=hidden name=adminid value=$adminid>New Password : <input type=password name=pass onkeyup=something();>&nbsp;<input type=submit value=Reset></form>";
echo '<div id="error1" style="color:red; display:none;">Please Enter Password > 6 Char</div>';
echo "</fieldset>";

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

echo '<fieldset><legend>Status Details</legend>';


echo "<form method=post action='user-dtlck.php'><input type=hidden name='todo' value='status-up'><input type=hidden name=f_name value='$f_name'>
<input type=hidden name=adminid value=$adminid>
<input type=radio name=status value='lock' $nsck>Locked <input type=radio name=status value='unlocked' $apvck>Not Locked 
<input type=radio name=status value='del' >Delete 

<input type=submit value='Update'> 


</form>
";

echo '</fieldset>';
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
