<?php
include "session.php";
require "../config.php";
require "check.php";

?>
<?php
$opt=$_POST[option];
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
$dq=$_SESSION['dq'];
$ct=$_SESSION['ct'];
$v=$_SESSION['v'];
$topic_ids=$_SESSION['topic_ids'];
$no_topics=$_SESSION['no_topics'];
$an="a".$k; 

mysql_query("UPDATE test SET $qn = '$qid'  
WHERE testid = '$tid1'") or die(mysql_error()); 
mysql_query($query);

mysql_query("UPDATE test SET $an='$opt' 
WHERE testid = '$tid1'") or die(mysql_error()); 


$data = mysql_query("SELECT answer FROM questionbank where qid=$qid");
while($row= mysql_fetch_array($data))
	{
		$ans=$row['answer'];
		break;
	}
if ($ans==$opt)
$u=1;
else
$u=0;

$st=stheta($u,$selp,$selpd);
$sums=$sums+$st;
$sumi=$sumi+$seli;
$tn=tnext($sums,$sumi,$t);
//if ($tn<-2)
//$tn=-2;

//if ($tn>2)
//$tn=2;

$t=$tn;
$setheta1=setheta($sumi);
$_SESSION['th']=$t;

$_SESSION['se']=$setheta1;

if($setheta1<=0.38 || $k==20)
{
if($k>=15)
{
echo '
<script type="text/javascript">
<!--
window.location = "score.php"
//-->
</script>';
}
}
$maxi=0;
$v[]=$qid;
$vis=join(",",$v);
$d=array(-2,-1,0,1,2);
for ($j=0; $j<=4; $j++)
{
	$p=prob($d[$j],$t);
	$p1[$j]=$p;
	$pd=prob1($d[$j],$t);
	$pd1[$j]=$pd;
	$i=iif($p,$pd);
	$iif1[$j]=$i;
	if($i>$maxi)
	{
		$maxi=$i;
		$maxdiff=$d[$j];
	}

}
for ($j=0; $j<$no_topics; $j++)
{
	$topicp[$j]=($dq[$j]-$ct[$j])/(15-$k);
	//echo "topicp ".$topicp[$j];
	$difference[$j]=$maxi-$iif1[$j];
}
$min=999;
for ($j=0; $j<=4; $j++)
{
	for ($z=0; $z<$no_topics; $z++)
	{
		$pen[$j][$z]=$difference[$j]-$topicp[$z];
		//echo "pen: ".$pen[$j][$z];
		//echo "j ".$j;
		//echo "z".$z;
		
		if($pen[$j][$z]<$min)
		{
			$min=$pen[$j][$z];
			$selj=$j;
			$selz=$z;
			$seld=$j-2;
			$selt=$topic_ids[$z];
			$selp=$p1[$j];
			$selpd=$pd1[$j];
			$seli=$iif1[$j];
		}
	}
}
//echo "min: ".$min;
$mino=$min;
$qn="q1";
$pv=array();
$pv[$selj][$selz]=1;
while(true)
{
 	$flag=0;
	while($flag==0)
	{
	$min1=999;
	$qs="SELECT * FROM questionbank where difficulty=$seld and sid=1 and tid=$selt and qid not in (".$vis.") order by rand()";
 	$nextq = mysql_query($qs) or die(mysql_error());
	$k=1;
	$qn="q1";
	$num_rows = mysql_num_rows($nextq);
	if($num_rows==0)
	{
		for ($j=0; $j<=4; $j++)
		{
		for ($z=0; $z<$no_topics; $z++)
		{
			if($pv[$j][$z]!=1)
			{
			if($pen[$j][$z]<$min1 && $pen[$j][$z]>=$min)
			{
				$min1=$pen[$j][$z];

				//echo "min1: ".$min1;
				$min2=$min1;
				$selj=$j;
				$selz=$z;
				$seld=$j-2;
				$selt=$topic_ids[$z];
				$selp=$p1[$j];
				$selpd=$pd1[$j];
				$seli=$iif1[$j];
			}
			}
		}
		}	
	}
	else
	{
					
		$flag=1;
	}
	$min=$min1;
	$pv[$selj][$selz]=1;
	}
	
	while($row= mysql_fetch_array($nextq))
	{
					
		$qid=$row['qid'];
		$q=$row['question'];
		$o1=$row['choice1'];
		$o2=$row['choice2'];
		$o3=$row['choice3'];
		$o4=$row['choice4'];
		$d1=$row['difficulty'];
		break;
	}

	$check=mysql_query("SELECT $qn FROM test where testid=$tid1")or die(mysql_error());
while($row= mysql_fetch_array($check))
	{
		$check1=$row[$qn];
		break;
	}
	while($qid!=$check1 && !is_null($check1))
	{
									
		$k=$k+1;
		$qn="q".$k;
		//echo "inside qn".$qn;
		//echo "i Qid ".$qid;
	$check=mysql_query("SELECT $qn FROM test where testid=$tid1")or die(mysql_error());
while($row= mysql_fetch_array($check))
	{
		
		$check1=$row[$qn];
		//echo "check1: ".$check1." ";
		break;
	}

	
	}
	if(is_null($check1))
	{
															break;
	}

}
for($j=0;$j<$no_topics;$j=$j+1)
{
	if($topic_ids[$j]==$selt)
		$pos=$j;
}
$ct[$pos]=$ct[$pos]+1;

$_SESSION['id1']=$qid;
$_SESSION['id2']=$tid1;
$_SESSION['k']=$k;
$_SESSION['qn']=$qn;
$_SESSION['sums']=$sums;
$_SESSION['sumi']=$sumi;
$_SESSION['seli']=$seli;
$_SESSION['selp']=$selp;
$_SESSION['selpd']=$selpd;
$_SESSION['t']=$t;
$_SESSION['dq']=$dq;
$_SESSION['ct']=$ct;
$_SESSION['v']=$v;
$_SESSION['min2']=$min2;
$_SESSION['pen']=$pen;
$_SESSION['mino']=$mino;
$_SESSION['topic_ids']=$topic_ids;
$_SESSION['no_topics']=$no_topics;
echo '
<script type="text/javascript">
<!--
window.location = "nq.php"
//-->
</script>';
//header("Location: nq.php");
//header("Location: nq.php?id1=$qid&id2=$tid&k=$k&qn=$qn&t=$t&sumi=$sumi&sums=$sums&maxi=$maxi&selp=$selp&selpd=$selpd&t=$t",false);

function prob($b,$t)
{
	$h=-1.7*($t-$b);
	$e=exp($h);
	$p=((1)/(1+$e));
	return $p;
}

function prob1($b,$t)
{
	$r=1.7;
	$w=-1.7*($t-$b);
	$w=exp($w);
	$t1=pow((1+$w),2);
	$pd=$r*$w/$t1;
	return $pd;
}

function iif($p,$pd)
{
	$i=($pd*$pd)/($p*(1-$p));
	return $i;
}

function stheta($u,$p,$pd)
{
	$st=($u-$p)*($pd/($p*(1-$p)));
	return $st;
}

function tnext($st,$i,$t)
{
	$tn=$t+($st/$i);
	return $tn;
}

function setheta($sumi)
{
	
	return (1/(sqrt($sumi)));
}
?>

