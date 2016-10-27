<?php
include "session.php";
require "../config.php";

require "check.php";


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
@$change=$_POST['change'];
if($change=="changeanswer")
{
	$qid=$_POST['qid'];
	$ans1=$_POST['ans1'];
	$answer=$_POST['answer'];
	$f_name=$_POST['f_name']; 

	if($ans1!=$answer)
	{
		$q=mysql_query("update questionbank set answer=$answer where qid=$qid");
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

}
else
{
	if($change=="changedifficulty")
	{
		$qid=$_POST['qid'];
		$diff1=$_POST['diff1'];
		$difficulty=$_POST['difficulty'];
		$f_name=$_POST['f_name']; 

		if($diff1!=$difficulty)
		{
			$q=mysql_query("update questionbank set difficulty=$difficulty where qid=$qid");
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

	}
	else
		header ("Location: $f_name&f_name=$f_name&msg=<br>Not able to Update Record "); 
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
