<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Administrator Posts</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
</head>
<?php
include ('style.php');
?>

<body>
<script type="text/javascript">

function val_all()
{
if(val_question()==true && val_ch1()==true && val_ch2()==true && val_ch3()==true && val_ch4()==true)
	return true;
	return false;
}

function val_question()
{
document.getElementById('error1').style.display="none";
if(document.enterquestion.question.value.length<2)
{
document.getElementById('error1').style.display="";
return false;
}
return true;
}

function val_ch1()
{
document.getElementById('error2').style.display="none";
if(document.enterquestion.ch1.value.length<2)
{
document.getElementById('error2').style.display="";
return false;
}
return true;
}

function val_ch2()
{
document.getElementById('error3').style.display="none";
if(document.enterquestion.ch2.value.length<2)
{
document.getElementById('error3').style.display="";
return false;
}
return true;
}

function val_ch3()
{
document.getElementById('error4').style.display="none";
if(document.enterquestion.ch3.value.length<2)
{
document.getElementById('error4').style.display="";
return false;
}
return true;
}

function val_ch4()
{
document.getElementById('error5').style.display="none";
if(document.enterquestion.ch4.value.length<2)
{
document.getElementById('error5').style.display="";
return false;
}
return true;
}

function selecttopic()
{
alert(document.enterquestion.subject.value);
}
</script>


<?php

require "check.php";
require "menu.php";


if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{ 
$adminid=$_SESSION['adminid'];
$s1=mysql_query("select * from staffsubject where adminid=$adminid");



//$s=mysql_query("select * from subjects where order by sid");
//$t=mysql_query("select * from topic order by tid");
	echo'
		<fieldset>
		<legend>Question Details</legend>
		<form action="" method="post" name="enterquestion" onsubmit="return val_all();">
		<input type=hidden name=todo value=question>
		<table>		
		<tr><td>Subject Name </td><td><select name="subject" onkeyup="selecttopic();"> ';
		while($re=mysql_fetch_array($s1))
		{

			$s=mysql_query("select * from subjects where sid=$re[subjectid]");
			while($nt2=mysql_fetch_array($s))
			{
			echo "<option value=$nt2[sid] >$nt2[section]</option>";
			}
		}
		
		
		echo '
		</select></td></tr>
		<tr><td>Topic Name </td><td><select name="topic"> ';

$s2=mysql_query("select * from staffsubject where adminid=$adminid");

		while($re1=mysql_fetch_array($s2))
		{


		
		$t=mysql_query("select * from topic where sid=$re1[subjectid]");
		while($nt3=mysql_fetch_array($t))
		{
		echo "<option value=$nt3[tid] >$nt3[tname]</option>";

		}	
		
		}		


		
	echo '		
		</select></td></tr>

		<tr><td>Question</td><td><textarea name="question" id="question" rows="5" cols="70"  onkeyup=val_question();></textarea></td></tr>
		<tr><td colspan="2"><div id="error1" style="color:red; display:none;">Please Enter Question > 1 Char</div></td></tr>
		<tr><td>Choice 1</td><td><textarea name="ch1" id="ch1" rows="1" cols="70"  onkeyup=val_ch1();></textarea></td></tr>
<tr><td colspan="2"><div id="error2" style="color:red; display:none;">Please Enter choice > 1 Char</div></td></tr>
		<tr><td>Choice 2</td><td><textarea name="ch2" id="ch2" rows="1" cols="70"  onkeyup=val_ch2();></textarea></td></tr>
<tr><td colspan="2"><div id="error3" style="color:red; display:none;">Please Enter choice > 1 Char</div></td></tr>
		<tr><td>Choice 3</td><td><textarea name="ch3" id="ch3" rows="1" cols="70"  onkeyup=val_ch3();></textarea></td></tr>
<tr><td colspan="2"><div id="error4" style="color:red; display:none;">Please Enter choice > 1 Char</div></td></tr>
		<tr><td>Choice 4</td><td><textarea name="ch4" id="ch4" rows="1" cols="70"  onkeyup=val_ch4();></textarea></td></tr>
<tr><td colspan="2"><div id="error5" style="color:red; display:none;">Please Enter choice > 1 Char</div></td></tr>
		<tr><td>Answer</td><td><select name="answer" id="answer">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		</select>
		</td></tr>
		<tr><td>Difficulty</td><td><select name="difficulty" id="difficulty">
		<option value="1">Very Easy</option>
		<option value="2">Easy</option>
		<option value="3">Medium</option>
		<option value="4">Difficult</option>
		<option value="5">Very Difficult</option>
		</select>
		</td></tr>

		<tr><td><input type="radio" name="complete" value="lock" id="complete_yes" />
		<label for="complete_yes">Locked</label></td>
		<td><input type="radio" name="complete" value="notlock" id="complete_no" />
		 <label for="complete_no">Not Locked</label></td></tr>
		<tr><td colspan="2" align="left"><input type="submit" value="Submit"></td></tr>
		</table>
		</form>
		</fieldset>
';

?>

<?php
@$todo=$_POST['todo'];
if(isset($todo) and $todo=="question")
{
$status=$_POST['complete'];
//echo $status;
$question=$_POST['question'];
$question=mysql_real_escape_string($question);
//echo "q:".$question;
$subject=$_POST['subject'];
$subject=mysql_real_escape_string($subject);
$topic=$_POST['topic'];
$topic=mysql_real_escape_string($topic);
$ch1=$_POST['ch1'];
$ch1=mysql_real_escape_string($ch1);
$ch2=$_POST['ch2'];
$ch2=mysql_real_escape_string($ch2);
$ch3=$_POST['ch3'];
$ch3=mysql_real_escape_string($ch3);
$ch4=$_POST['ch4'];
$ch4=mysql_real_escape_string($ch4);
$answer=$_POST['answer'];
$difficulty=$_POST['difficulty'];
if($difficulty==1)
	$difficulty=-2.5;
if($difficulty==2)
	$difficulty=-1.25;
if($difficulty==3)
	$difficulty=0;
if($difficulty==4)
	$difficulty=1.25;
if($difficulty==5)
	$difficulty=2.5;
$date=date("Y/m/d");
$questionmaker=$_SESSION['username'];

$query=mysql_query("insert into questionbank(question,sid,tid,choice1,choice2,choice3,choice4,answer,difficulty,date,questionmaker) values('$question','$subject','$topic','$ch1','$ch2','$ch3','$ch4','$answer','$difficulty','$date','$questionmaker')");
echo mysql_error();
echo'<div id="message">';
echo "<font face='Verdana' size='2' color=green>Thank you for posting your comment<br></font>";
echo'</div>';
if($_SESSION['userlevel']==1)
echo '<script>window.location="allquestions.php"</script>';
if($_SESSION['userlevel']==2)
echo '<script>window.location="sub-questions.php"</script>';
}
?>

<?php

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
