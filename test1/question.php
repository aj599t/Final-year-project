<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title></title><meta name="viewport" content="width=400" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script>
function checkRadio (frmName, rbGroupName) {
 var radios = document[frmName].elements[rbGroupName];
 for (var i=0; i <radios.length; i++) {
  if (radios[i].checked) {
   return true;
  }
 }
 return false;
}

function valFrm() {
 if (!checkRadio("qanswer","option"))
  {alert("Select an option"); return false;}
 else
  return true;
}
</script>
</head>


<body>

<?php

require "check.php";
//require "menu.php";


@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";}

////////////////////////////////////////////////////////////////
$uid=$_SESSION['uid'];
$t1=mysql_query("SELECT * FROM test where uid=$uid");
$v=array();
$_SESSION['v']=$v;
$first=1;
while($t2=mysql_fetch_array($t1))
{
	$qnn="q1";
	$k=1;

	while(!is_null($t2[$qnn]))
	{
	$first=0;
	$v[]=$t2[$qnn];
	$k=$k+1;
	$qnn="q".$k;
	}

}
$_SESSION['v']=$v;
$vis=join(",",$v);
$sid=$_POST['sid'];
$difficulty=$_POST['difficulty'];
$_SESSION['sid']=$sid;

if($first==0)
 $data = mysql_query("SELECT * FROM questionbank where difficulty=$difficulty and sid=$sid  and qid not in (".$vis.") order by rand()") or die(mysql_error());
else
 $data = mysql_query("SELECT * FROM questionbank where difficulty=$difficulty and sid=$sid order by rand()") or die(mysql_error());

$s=mysql_fetch_array(mysql_query("select * from subjects where sid='$sid'"));
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
$dt=date("Y-m-d H:i:s");
$ins="INSERT INTO test (date_time, uid, sid, q1) VALUES ('$dt',$uid,$sid,$qid)";
mysql_query($ins) or die(mysql_error());
$tid1=mysql_insert_id();
?>
<div id="container">

<div id="header">
<h1>
RAY Placements
</h1>
</div>
<div id="menu">
<h2><div id="one">Test ID: <?php echo $tid1 ?></div><div id="two">Section: <?php echo $s['section'] ?></div></h2>
</div>
<div id="content">
<h1>Question 1:</h1>

<?php
echo '<h3>'.$q.$answer.$difficulty.$topic.'</h3>';
?>
<form name="qanswer" action="algo.php" method="post" onsubmit="return valFrm();">
<INPUT type = "hidden" name="id" value=<?php echo $qid; ?>></input>
<h4><input type="radio" name="option" value="1" checked /> <?php echo $o1; ?></h4>
<h4><input type="radio" name="option" value="2" /><?php echo $o2; ?> </h4>
<h4><input type="radio" name="option" value="3" /> <?php echo $o3; ?></h4>
<h4><input type="radio" name="option" value="4" /> <?php echo $o4; ?></h4>
<input type=hidden name=sid value= <?php echo $sid ?> />
<input type=hidden name=tid1 value= <?php echo $tid1 ?> />
</div>
<div id="footer">
<form>
<input type="submit" name="Next" value="Next"></input>
</form>
<div>

</div>
<?php


mysql_close();
?>


</body>
</html>