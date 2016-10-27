<?php
include "session.php";
require "../config.php";

require "check.php";


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
@$changesubject=$_POST['changesubject'];
if($changesubject=="change")
{
	$sid1=$_POST['sid1'];
	$sid2=$_POST['sid2'];
	$tid1=$_POST['tid1'];
	$f_name=$_POST['f_name']; 

	if($sid1!=$sid2)
	{
		$q=mysql_query("update topic set sid=$sid1 where tid=$tid1");
		if(mysql_affected_rows() <> 1)
		{
			header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to Update Record "); 
		}
		else
		{
			header ("Location: $f_name&f_name=$f_name&msg=<br>Record Updated ");
		}
	}
	else
	{
		header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to Update Record "); 
	}

}// end of if else
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
