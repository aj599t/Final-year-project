<?php
require 'session.php';
?>
<?php
require "../config.php";
?>
<?php
$studentlogin=$_POST['studentlogin'];
$studentlogin=mysql_real_escape_string($studentlogin);
$password=$_POST['password'];
$password=mysql_real_escape_string($password);

//echo $studentlogin;
//echo $password;

if($rec=mysql_fetch_array(mysql_query("SELECT * FROM students WHERE studentlogin='$studentlogin' AND password = '$password'")))
	{
		if(($rec['studentlogin']==$studentlogin)&&($rec['password']==$password))
		{
			
			$studentname=$rec['studentname'];
			$uid=$rec['uid'];
			$studentlogin=$rec['studentlogin'];
			include "newsession.php";
		        echo "Y";
		     	print "<script>";
       			print " self.location='test.php';";
	        	print "</script>";
		} 
	}	
	else 
	{
	//	session_unset();
		echo "X";	
	}

?>


