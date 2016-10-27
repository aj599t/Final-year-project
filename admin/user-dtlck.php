<?php
include "session.php";
require "../config.php";

require "check.php";
if($_SESSION['userlevel']==1)
{

////////////////////////////////////////////////////////////////////////////////////////////
@$todo=$_POST['todo'];
if($todo=="status-up"){
$f_name=$_POST['f_name'];
$adminid=$_POST['adminid'];
$status=$_POST['status'];
if($status=="del"){
$q=mysql_query("delete from staff where adminid=$adminid");
if(mysql_affected_rows() <> 1){
header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to delete Record "); 
}else{header ("Location: $f_name&f_name=$f_name&msg=<br>Record  deleted "); }
}else{
$q=mysql_query("update  staff set status='$status' where adminid=$adminid ");
echo mysql_error();
if(mysql_affected_rows() <> 1){
header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to update Record "); 
}else{header ("Location: $f_name&f_name=$f_name&msg=<br>Record updated "); }


}// end of if else
}// end of todo checking
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
