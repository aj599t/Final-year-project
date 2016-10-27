<?php
include "session.php";
require "../config.php";
?>

<HTML>
<HEAD>
<TITLE>Check</TITLE>
</HEAD>
<BODY  TOPMARGIN='0' >

<?php

$id=$_POST['id'];
$id=mysql_real_escape_string($id);
$pw=$_POST['pw'];
$pw=mysql_real_escape_string($pw);


	if($rec=mysql_fetch_array(mysql_query("SELECT * FROM staff WHERE username='$id' AND password = '$pw'")))
	{
		if(($rec['username']==$id)&&($rec['password']==$pw))
		{
			$userlevel=$rec['userlevel'];
			//echo $userlevel;
			$username=$rec['name'];
			$adminid=$rec['adminid'];
			include "newsession.php";
		        echo "<p class=data> <center>Successfully,Logged in<br><br><a href='logout.php'> Log OUT </a><br><br><a href=add.php>Click here if your browser 			is not	redirecting automatically or you don't want to wait.</a><br></center>";
		     	print "<script>";
       			print " self.location='demo.php';";
	        	print "</script>";
		} 
	}	
	else 
	{
		session_unset();
		echo "<font face='Verdana' size='2' color=red>Wrong Login. Use your correct  Userid and Password and Try <br><center><input type='button' value='Retry' 		onClick='history.go(-1)'></center>";	
	}
  
?>
</body>
</html>
