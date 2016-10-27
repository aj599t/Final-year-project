<?php
include "session.php";
require "../config.php";

require "check.php";
if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
@$todo=$_POST['todo'];
if($todo=="status-up")
{ 
	$f_name=$_POST['f_name'];
	$qid=$_POST['qid'];
	$status=$_POST['status'];
	
	if($status=="del")
	{
		$q=mysql_query("delete from questionbank where qid=$qid");
		if(mysql_affected_rows() <> 1)
			header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to delete Question "); 
		else
			header ("Location: $f_name&f_name=$f_name&msg=<br>Question  deleted "); 

	}
	else
	{
		$q=mysql_query("update  questionbank set status='$status' where qid=$qid ");
		echo mysql_error();
		if(mysql_affected_rows() <> 1)
			header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to update Question "); 
		else
			header ("Location: $f_name&f_name=$f_name&msg=<br>Question updated "); 

	}// end of if else
}// end of todo checking
else
{
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
