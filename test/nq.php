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
$min2=$_SESSION['min2'];
$mino=$_SESSION['mino'];
$pen=$_SESSION['pen'];
$ct=$_SESSION['ct'];
$topic_ids=$_SESSION['topic_ids'];
$no_topics=$_SESSION['no_topics'];
echo "n".$no_topics;
$data = mysql_query("SELECT * FROM questionbank where qid=$qid") 
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
echo "Question No: ".$k;
?>
<br/>
<?php
echo $q." topic:".$topic." difficulty:".$difficulty." answer:".$answer." min2:".$min2." mino:".$mino."<br/>//";
/*for ($j=0; $j<=4; $j++)
{
	for ($z=0; $z<=4; $z++)
	{
	echo $pen[$j][$z]." ";
	}
echo "<br/>";
}
for ($j=0; $j<=4; $j++)
echo $ct[$j];*/
?><html>
<body>

<form action="algo1.php" method="post">
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
<h4><input type="radio" name="option" value="1" /> <?php echo $o1; ?></h4>
<h4><input type="radio" name="option" value="2" /><?php echo $o2; ?> </h4>
<h4><input type="radio" name="option" value="3" /> <?php echo $o3; ?></h4>
<h4><input type="radio" name="option" value="4" /> <?php echo $o4; ?></h4>

<INPUT type = "hidden" name="id" value=<?php echo $qid; ?>></input>


<input type="submit" name="Next" value="Next"></input>
</form>
</body>
</html>

