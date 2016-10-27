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
<script type="text/javascript">

function val_topicname()
{
document.getElementById('error1').style.display="none";
if(document.entertopic.topicname.value.length<2)
{
document.getElementById('error1').style.display="";
return false;
}
return true;
}

</script>


<?php

require "check.php";
require "menu.php";


if($_SESSION['userlevel']==2)
{ 
$adminid=$_SESSION['adminid'];
$s1=mysql_query("select * from staffsubject where adminid=$adminid");
//$s=mysql_query("select * from subjects where  order by sid");

	echo'
		<fieldset>
		<legend>Topic Details</legend>
		<form action="" method="post" name="entertopic" onsubmit="return val_topicname();">
		<table>
		<input type=hidden name=todo value=topic_name>
		<tr><td>Topic Name</td><td><input type="text" width="50" onkeyup=val_topicname(); id="topicname" name="topicname"></td></tr>
		<tr><td colspan="2"><div id="error1" style="color:red; display:none;">Please Enter Name > 1 Char</div></td></tr>
		<tr><td>Subject Name</td><td><select name="subject"> ';
		while($re=mysql_fetch_array($s1))
		{
			$s=mysql_query("select * from subjects where sid=$re[subjectid]");
			while($nt2=mysql_fetch_array($s))
			{
			echo "<option value=$nt2[sid] >$nt2[section]</option>";
			}
		}
				
echo'		</select></td></tr>
		<tr><td><input type="radio" name="complete" value="lock" id="complete_yes" />
 		<label for="complete_yes">Locked</label></td><td><input type="radio" name="complete" value="notlock" id="complete_no" />
		 <label for="complete_no">Not Locked</label></td></tr>
		<tr><td colspan="2" align="center"><input type="submit" value="submit"></td></tr>
		</table>
		</form>
		</fieldset>
';
?>

<?php
@$todo=$_POST['todo'];
if(isset($todo) and $todo=="topic_name")
{
$name=$_POST['topicname'];
$name=mysql_real_escape_string($name);
$status=$_POST['complete'];
$subject=$_POST['subject'];
//echo $status;
$query=mysql_query("insert into topic(sid,tname,status) values('$subject','$name','$status')");
echo mysql_error();
echo'<div id="message">';
echo "<font face='Verdana' size='2' color=green>Thank you for posting your comment<br></font>";
echo'</div>';
echo '<script>window.location="sub-alltopic.php"</script>';
}
?>

<?php

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
