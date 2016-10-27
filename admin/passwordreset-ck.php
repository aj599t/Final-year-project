<?php
include "session.php";
require "../config.php";

require "check.php";
if($_SESSION['userlevel']==1)
{

///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
@$todo=$_POST['todo'];
if($todo=="passwordreset"){
$f_name=$_POST['f_name'];
$adminid=$_POST['adminid'];
$pass=$_POST['pass'];

$q=mysql_query("update  staff set password='$pass' where adminid=\"$adminid\"");
echo mysql_error();

if(mysql_affected_rows() <> 1){
header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to Reset"); 
}else{header ("Location: $f_name&f_name=$f_name&msg=<br>Password Reset Successful "); }

}
else{
header ("Location: $f_name&f_name=$f_name&msg=<br>Data Problem"); 
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