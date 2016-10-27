<?php
include "session.php";
require "../config.php";
require "check.php";
?>
<?php
$qid=$_SESSION['id1'];
$tid1=$_SESSION['id2'];
$k=$_SESSION['k'];
$qn=$_SESSION['qn'];
$sums=$_SESSION['sums'];
$sumi=$_SESSION['sumi'];
$seli=$_SESSION['seli'];
$selp=$_SESSION['selp'];
$selpd=$_SESSION['selpd'];
$t=$_SESSION['t'];
$v=$_SESSION['v'];
$ct=$_SESSION['ct'];
$topic_ids=$_SESSION['topic_ids'];
$no_topics=$_SESSION['no_topics'];
$sid=$_SESSION['sid'];
$vis=$_SESSION['vis'];

$data = mysql_query("SELECT * FROM questionbank where qid=$qid")
 or die(mysql_error());
$s=mysql_fetch_array(mysql_query("select * from subjects where sid=$sid"));
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

?>

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
<h1>Question <?php echo $k; ?>:</h1>

<?php
echo '<h3>'.$q." ".$answer." ".$difficulty." ".$topic." ".$t.'</h3>';
?>



<form name="qanswer" action="algo1.php" method="post" onsubmit="return valFrm();">
<INPUT type = "hidden" name="id1" value=<?php echo $qid; ?>></input>
<INPUT type = "hidden" name="id2" value=<?php echo $tid1; ?>></input>
<INPUT type = "hidden" name="id3" value=<?php echo $k; ?>></input>
<INPUT type = "hidden" name="id4" value=<?php echo $qn; ?>></input>
<INPUT type = "hidden" name="id5" value=<?php echo $sums; ?>></input>
<INPUT type = "hidden" name="id6" value=<?php echo $sumi; ?>></input>

<INPUT type = "hidden" name="id7" value=<?php echo $seli; ?>></input>

<INPUT type = "hidden" name="id8" value=<?php echo $selp; ?>></input>

<INPUT type = "hidden" name="id9" value=<?php echo $selpd; ?>></input>
<INPUT type = "hidden" name="id10" value=<?php echo $t; ?>></input>
<h4><input type="radio" name="option" value="1" checked/> <?php echo $o1; ?></h4>
<h4><input type="radio" name="option" value="2" /><?php echo $o2; ?> </h4>
<h4><input type="radio" name="option" value="3" /> <?php echo $o3; ?></h4>
<h4><input type="radio" name="option" value="4" /> <?php echo $o4; ?></h4>

<INPUT type = "hidden" name="id" value=<?php echo $qid; ?>></input>

</div>
<div id="footer">
<form>
<input type="submit" name="Next" value="Next"></input>
</form>
<div>

</div>
</body>
</html>

