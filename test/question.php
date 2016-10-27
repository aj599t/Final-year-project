<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Select Subject</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
</head>
<?php
include ('style.php');
?>

<body>

<?php

require "check.php";
//require "menu.php";


@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";}

////////////////////////////////////////////////////////////////

  $sid=$_POST['sid'];
$difficulty=$_POST['difficulty'];
 $data = mysql_query("SELECT * FROM questionbank where difficulty=$difficulty and sid=$sid order by rand()") 
 or die(mysql_error()); 
while($row= mysql_fetch_array($data))
{
$qid=$row['qid'];
$q=$row['question'];
$o1=$row['choice1'];
$o2=$row['choice2'];
$o3=$row['choice3'];
$o4=$row['choice4'];
$topic=$row['tid'];
$difficulty=$row['difficulty'];
$answer=$row['answer'];
break;
}
echo "Question No: 1";
?>
<br/>
<?php
echo $q." topic:".$topic." difficulty:".$difficulty." answer:".$answer;
?>
<form action="algo.php" method="post">
<INPUT type = "hidden" name="id" value=<?php echo $qid; ?>></input>
<h4><input type="radio" name="option" value="1" /> <?php echo $o1; ?></h4>
<h4><input type="radio" name="option" value="2" /><?php echo $o2; ?> </h4>
<h4><input type="radio" name="option" value="3" /> <?php echo $o3; ?></h4>
<h4><input type="radio" name="option" value="4" /> <?php echo $o4; ?></h4>
<input type="submit" name="Next" value="Next"></input>
</form>


<?php


mysql_close();
?>
 
 
</body>
</html>