<?php
include "session.php";
require "../config.php";

require "check.php";

////////////////////////////////////////////////////////////////////////////////////////////
@$todo=$_POST['todo'];
if($todo=="status-up"){
$f_name=$_POST['f_name'];
$event_id=$_POST['event_id'];
$status=$_POST['status'];
if($status=="del"){
$q=mysql_query("delete from iam_event where event_id=$event_id");
if(mysql_affected_rows() <> 1){
header ("Location: $f_name?msg=<br>Not able to delete Record "); 
}else{header ("Location: $f_name?msg=<br>Record  deleted "); }

}else{
$q=mysql_query("update  iam_event set status='$status' where event_id=$event_id ");
echo mysql_error();
if(mysql_affected_rows() <> 1){
header ("Location: $f_name?msg=<br>Not able to update Record "); 
}else{header ("Location: $f_name?msg=<br>Record updated "); }


}// end of if else
}// end of todo checking
else{
header ("Location: $f_name?msg=<br>Data Problem"); 
}
//////////////////////////////////////////////////////////////////////////////////////////////  

?>
</body>
</html>
