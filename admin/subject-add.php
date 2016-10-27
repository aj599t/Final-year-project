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

function val_subjectname()
{
document.getElementById('error1').style.display="none";
if(document.entersubject.subjectname.value.length<2)
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


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{ 
	echo'
		<fieldset>
		<legend>Subject Details</legend>
		<form action="" method="post" name="entersubject" onsubmit="return val_subjectname();">
		<table><script>val_subjectname();</script>
		<input type=hidden name=todo value=subject_name>
		<tr><td>Subject Name</td><td><input type="text" width="50" onkeyup=val_subjectname(); id="subjectname" name="subjectname"></td></tr>
		<tr><td colspan="2"><div id="error1" style="color:red; display:none;">Please Enter Name > 1 Char</div></td></tr>
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
if(isset($todo) and $todo=="subject_name")
{
$name=$_POST['subjectname'];
$name=mysql_real_escape_string($name);
$status=$_POST['complete'];
//echo $status;
$query=mysql_query("insert into subjects(section,status) values('$name','$status')");
echo mysql_error();
echo'<div id="message">';
echo "<font face='Verdana' size='2' color=green>Thank you for posting your comment<br></font>";
echo'</div>';
echo '<script>window.location="allsubjects.php"</script>';
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
