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

function val_username()
{

document.getElementById('error1').style.display="none";

if(document.userdtl.usernme.value.length<3)
{

document.getElementById('error1').style.display="";
return false;
}
return true;
}

function val_passwrd()
{

document.getElementById('error2').style.display="none";
if(document.userdtl.passwrd.value.length<6)
{
document.getElementById('error2').style.display="";
return false;
}
return true;
}

function val_nme()
{

document.getElementById('error3').style.display="none";
if(document.userdtl.nme.value.length<3)
{
document.getElementById('error3').style.display="";
return false;
}
return true;
}
</script>


<?php

require "check.php";
require "menu.php";


if($_SESSION['userlevel']==1)
{ 
$s=mysql_query("select * from userlevel order by userlevel");
	echo'
		<fieldset>
		<legend>User Details</legend>
		<form action="" method="post" name="userdtl" onsubmit="return val_username();">
		<table>
		<input type=hidden name=todo value=user_name>
		<tr><td>UserName</td><td><input type="text" width="50" onkeyup=val_username(); id="usernme" name="usernme"></td></tr>
		<tr><td colspan="2"><div id="error1" style="color:red; display:none;">Please Enter Name > 2 Char</div></td></tr>
		<tr><td>Password</td><td><input type="password" width="50" onkeyup=val_passwrd(); id="passwrd" name="passwrd"></td></tr>
		<tr><td colspan="2"><div id="error2" style="color:red; display:none;">Please Enter Password > 6 Char</div></td></tr></td></tr>
		<tr><td>Name</td><td><input type="text" width="50" onkeyup=val_nme(); id="nme" name="nme"></td></tr>
		<tr><td colspan="2"><div id="error3" style="color:red; display:none;">Please Enter Name > 2 Char</div></td></tr>
		<tr><td>User Level</td><td><select name="userlvl">';
while($nt2=mysql_fetch_array($s)){
echo "<option value=$nt2[userlevel] >$nt2[levelname]</option>";
}
echo '</select></td></tr>
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
if(isset($todo) and $todo=="user_name")
{
$name=$_POST['usernme'];
$name=mysql_real_escape_string($name);
$nme=$_POST['nme'];
$nme=mysql_real_escape_string($nme);
$passwrd=$_POST['passwrd'];
$passwrd=mysql_real_escape_string($passwrd);
$userlvl=$_POST['userlvl'];

$status=$_POST['complete'];

//echo $status;
$query=mysql_query("insert into staff(username,password,name,userlevel,status) values('$name','$passwrd','$nme','$userlvl','$status')");
echo mysql_error();
echo'<div id="message">';
echo "<font face='Verdana' size='2' color=green>Thank you for posting your comment<br></font>";
echo'</div>';
echo '<script>window.location="allusers.php"</script>';
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
