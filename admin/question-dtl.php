<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Question Detail</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
<?php
include ('style.php');
?>

</head>

<body >  
<?php

require "check.php";
require "menu.php";
@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

//error_reporting(E_ALL ^ E_NOTICE);
if($_SESSION['userlevel']==1 || $_SESSION['userlevel']==2)
{

////////////////////////////////////////////////////////////////////////////////////////////
$qid=$_GET['qid'];
$f_name=$_GET['f_name'];
$q=mysql_query("select * from questionbank where qid=$qid ");
echo mysql_error();
$row=mysql_fetch_object($q);
$editable=$_GET['editable'];

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Questionid</b>:$row->qid </td></tr>";

if($editable=="")
{
	echo "<tr><td colspan=2>Question:</td></tr>";
	echo "<tr ><td colspan=2>$row->question <br/><br/></td></tr>";
	echo "<tr><td colspan=2>1. &nbsp;$row->choice1 </td></tr>";
	echo "<tr><td colspan=2>2. &nbsp;$row->choice2 </td></tr>";
	echo "<tr><td colspan=2>3. &nbsp;$row->choice3 </td></tr>";
	echo "<tr><td colspan=2>4. &nbsp;$row->choice4 </td></tr>";

	echo "<tr><td><a href=\"question-dtl.php?qid=$qid&f_name=$f_name&editable=1\">Edit Question </a></td></tr>";

}
else
{	
	if($editable=="1")
	{
		
	echo '<form action="question-dtl.php" method="get">';
	echo "<input type=hidden name=qid value=$qid>";		
	echo "<input type=hidden name=f_name value='$f_name'>";
	echo "<input type=hidden name=editable value=2>";
	echo "<tr><td colspan=2>Question:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"text1\" rows=\"20\" cols=\"100\">$row->question</textarea></td></tr>";
	echo "<tr><td colspan=2>Choice 1:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"ch1\" rows=\"5\" cols=\"100\">$row->choice1</textarea></td></tr>";
	echo "<tr><td colspan=2>Choice 2:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"ch2\" rows=\"5\" cols=\"100\">$row->choice2</textarea></td></tr>";
	echo "<tr><td colspan=2>Choice 3:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"ch3\" rows=\"5\" cols=\"100\">$row->choice3</textarea></td></tr>";
	echo "<tr><td colspan=2>Choice 4:</td></tr>";
	echo "<tr ><td colspan=2><textarea name=\"ch4\" rows=\"5\" cols=\"100\">$row->choice4</textarea></td></tr>";
		
	echo "<tr><td><input type=\"submit\" /></td><td><a href=\"question-dtl.php?qid=$qid&f_name=$f_name\">Cancel</a></td></tr>";
	echo '</form>';

	}


	else
	{	
		if($editable=="2")
		{
	
		$text1=$_GET['text1'];
		$ch1=$_GET['ch1'];
		$ch2=$_GET['ch2'];
		$ch3=$_GET['ch3'];
		$ch4=$_GET['ch4'];

		$q1=mysql_query("update  questionbank set question='$text1' where qid=$qid ");
		echo mysql_error();
		$q2=mysql_query("update  questionbank set choice1='$ch1' where qid=$qid ");
		echo mysql_error();
		$q3=mysql_query("update  questionbank set choice2='$ch2' where qid=$qid ");
		echo mysql_error();
		$q4=mysql_query("update  questionbank set choice3='$ch3' where qid=$qid ");
		echo mysql_error();
		$q5=mysql_query("update  questionbank set choice4='$ch4' where qid=$qid ");
		echo mysql_error();
	
		$q=mysql_query("select * from questionbank where qid=$qid ");
		echo mysql_error();
		$row=mysql_fetch_object($q);


		echo "<tr><td colspan=2>Question:</td></tr>";
		echo "<tr ><td colspan=2>$row->question <br/><br/></td></tr>";
		echo "<tr><td colspan=2>1. &nbsp;$row->choice1 </td></tr>";
		echo "<tr><td colspan=2>2. &nbsp;$row->choice2 </td></tr>";
		echo "<tr><td colspan=2>3. &nbsp;$row->choice3 </td></tr>";
		echo "<tr><td colspan=2>4. &nbsp;$row->choice4 </td></tr>";
		echo "<tr><td><a href=\"question-dtl.php?qid=$qid&f_name=$f_name&editable=1\">Edit Question</a></td></tr>";
		
		}

		else
		{

		
			$q=mysql_query("select * from question where qid=$qid ");
			echo mysql_error();
			$row=mysql_fetch_object($q);


			echo "<tr><td colspan=2>Question:</td></tr>";
			echo "<tr ><td colspan=2>$row->question <br/><br/></td></tr>";
			echo "<tr><td colspan=2>1. &nbsp;$row->choice1 </td></tr>";
			echo "<tr><td colspan=2>2. &nbsp;$row->choice2 </td></tr>";
			echo "<tr><td colspan=2>3. &nbsp;$row->choice3 </td></tr>";
			echo "<tr><td colspan=2>4. &nbsp;$row->choice4 </td></tr>";
			echo "<tr><td><a href=\"question-dtl.php?qid=$qid&f_name=$f_name&editable=1\">Edit Question</a></td></tr>";
		

		}
	}
}

echo "</table>";
echo "<hr>";

$r=mysql_query("select * from questionbank where qid=\"$row->qid\"");

$nt1=mysql_fetch_array($r);
if($nt1['difficulty']=='-2.5')
	$diff="Very Easy";
if($nt1['difficulty']=='-1.25')
	$diff="Easy";
if($nt1['difficulty']=='0')
	$diff="Medium";
if($nt1['difficulty']=='1.25')
	$diff="Difficult";
if($nt1['difficulty']=='2.5')
	$diff="Very Difficult";
echo '<table border="1" style="border:solid;"><tr><td>Answer</td><td>';echo $nt1['answer'];
echo '</td></tr><tr><td>Difficulty</td><td>'; echo $diff;
echo'</td></tr></table>';
echo "<hr>";
//$s=mysql_query("select * from subjects order by sid");
echo '<form method="post" action="questionchange-ansdiff.php">';
echo '<table><tr><td>';
echo 'Answer: &nbsp;';
echo '<select name="answer">';
for($ansctr=1;$ansctr<=4;$ansctr++)
{
	if($nt1[answer]==$ansctr)
	{
?>
		<option value=<?php echo $ansctr;?> selected>

<?php		echo $ansctr; 
		echo '</option>';
	}
	else
	{
		?>
		<option value=<?php echo $ansctr;?>>

<?php		echo $ansctr; 
		echo '</option>';
	}
}
echo  '</select> &nbsp;';
echo '<input type=hidden name="change" value="changeanswer">';
echo "<input type=hidden name=qid value=$row->qid>";
echo "<input type=hidden name=ans1 value=$nt1[answer]>";
echo "<input type=hidden name=f_name value=$f_name>";
echo '<input type="submit" value="Update"></td>';
echo '</form>';

echo '<form method="post" action="questionchange-ansdiff.php">';
echo '<td>';
echo 'Difficulty: &nbsp;';
//$levelsn=array("-2.5","-1.25","0","1.25","2");
$levels=array(
'-2.5' => 'Very Easy',
'-1.25' => 'Easy',
'0' => 'Medium',
'1.25' => 'Difficult',
'2.5' => 'Very Difficult');

echo '<select name="difficulty">';

foreach($levels as $key =>$lctr)
{
	if($diff==$lctr)
	{
?>
		<option value=<?php echo $key; ?> selected>
<?php
		echo $lctr; 
		echo '</option>';
	}
	else
	{
?>
		<option value= <?php echo $key; ?> >
<?php
		echo $lctr; 
		echo '</option>';
	}

}
echo  '</select> &nbsp;';
echo "<input type=hidden name=qid value=$row->qid>";
echo "<input type=hidden name=diff1 value=$nt1[difficulty]>";
echo '<input type=hidden name="change" value="changedifficulty">';
echo "<input type=hidden name=f_name value=$f_name>";
echo '<input type="submit" value="Update"></td></tr></table>';
echo '</form>';
echo "<hr>";
//////////////////////////////////////////////////////////////////////////////////////////////  

//////////// Updation starts ////////////////////

switch($row->status)
{
case "ns":
$nsck="checked";
$apvck="";

break;

case "apv":
$apvck="checked";
$nsck="";

break;


default:
$apvck="";
$nsck="";
break;

}


echo "<form method=post action='question-dtlck.php'><input type=hidden name='todo' value='status-up'><input type=hidden name=f_name value='$f_name'>
<input type=hidden name=qid value=$qid>
<input type=radio name=status value='ns' $nsck>Not Seen <input type=radio name=status value='apv' $apvck>Approved 
<input type=radio name=status value='del' >Delete 

<input type=submit value='Update'> 


</form>
";


///////////Updation ends ////////////////////////
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
