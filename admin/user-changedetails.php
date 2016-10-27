<?php
include "session.php";
require "../config.php";

require "check.php";
//require "menu.php";

//include "menu.php";
//error_reporting(E_ALL ^ E_NOTICE);
if($_SESSION['userlevel']==1)
{

////////////////////////////////////////////////////////////////////////////////////////////
$f_name=$_GET['f_name'];
$adminid1=$_GET['adminid1'];
$editable=$_GET['editable'];


if($editable==3)
{
$levelname=$_GET['levelname'];
$s=mysql_query("Select * from staff where adminid=$adminid1");
echo mysql_error();
$row=mysql_fetch_object($s);
$u=mysql_query("Select * from userlevel");
echo mysql_error();
$r1=$row->name;

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Admin ID:</b>$adminid1</td></tr>";
	
echo '<form action="" method="get">';
	echo "<tr><td colspan=2>Name:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"name1\" rows=\"1\" cols=\"50\">$row->name</textarea></td></tr>";
	echo "<tr><td colspan=2>Username:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"username\" rows=\"1\" cols=\"50\">$row->username</textarea></td></tr>";
	echo "<tr><td colspan=2>User level:</td></tr>";
echo "<tr><td colspan=2><select name=ul>";
while($row1= mysql_fetch_array($u))
{
	//echo $row1['levelname'];
	if($row1['levelname']==$levelname)
	{
?>		<option value=<?php echo $row1['userlevel']; ?> selected><?php echo $row1['levelname']; ?></option>
<?php }   else{
?>
		<option value= <?php echo $row1['userlevel']; ?>><?php echo $row1['levelname']; ?></option>
		
<?php
	}
}
	
echo '</td></tr></select>';
	echo "<input type=hidden name=editable value=4></input>";		
	echo "<input type=hidden name=adminid1 value=$adminid1></input>";		
	echo "<input type=hidden name=f_name value=$f_name></input>";
	echo "<input type=hidden name=nameold value=$r1></input>";
	echo "<tr><td><br/><input type=\"submit\" /></td><td><br/><a href=\"$f_name&f_name=$f_name&adminid=$adminid1\">Cancel</a></td></tr></table>";
	echo '</form>';

}
else
{
if($editable==4)
{
	$name1=$_GET['name1'];
	$username=$_GET['username'];
	$ul=$_GET['ul'];
	//$f_name=$_GET['f_name'];
	//echo $f_name;
	$nameold=$_GET['nameold'];
	$q1=mysql_query("update  staff set name='$name1' where adminid=$adminid1");
	echo mysql_error();
	$q2=mysql_query("update  staff set username='$username' where adminid=$adminid1");
	echo mysql_error();
	$q3=mysql_query("update  staff set userlevel='$ul' where adminid=$adminid1");
	echo mysql_error();
	$q3=mysql_query("update  questionbank set questionmaker='$name1' where questionmaker='$nameold'");
	echo mysql_error();
	header ("Location: $f_name&f_name=$f_name&adminid=$adminid1&adminid1=$adminid1&msg=Record Updated");
	
	
}
else
{
}
}
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
