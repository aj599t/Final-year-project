<?php
include "session.php";
require "../config.php";

require "check.php";


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
@$todo=$_POST['todo'];
if($todo=="status-up"){
$f_name=$_POST['f_name'];
//echo $f_name;
$tid=$_POST['tid'];
$status=$_POST['status'];
if($status=="del"){
$q=mysql_query("delete from topic where tid=$tid");
if(mysql_affected_rows() <> 1){
header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to delete Record "); 
}else{header ("Location: alltopics.php?f_name=$f_name&msg=<br>Record  deleted "); }

}else{
$q=mysql_query("update  topic set status='$status' where tid=$tid ");
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
