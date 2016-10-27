<?php
include "session.php";
require "../config.php";
require "check.php";

?>

<?php
$id=$_POST['id'];
$sid=$_POST['sid'];
$opt=$_POST['option'];
$tid1=$_POST['tid1'];
$dq=array();
$ct=array();
$p1=array();
$pd1=array();
$iif1=array();
$topicp=array();
$difference=array();
$_SESSION['dq']=$dq;
$_SESSION['ct']=$ct;
$v=$_SESSION['v'];

$t=mysql_query("select * from topic where sid=$sid order by tid");
while($d=mysql_fetch_array($t))
{
	$dq[]=$d['dq'];
	$ct[]=0;
}
$p1=array();
$pd1=array();
$iif1=array();
$topicp=array();
$difference=array();
$dt=date("Y-m-d H:i:s");

$ins="update test set a1=".$_POST['option']." where testid=$tid1";
mysql_query($ins);


$data = mysql_query("SELECT answer FROM questionbank where qid=$id");

while($row= mysql_fetch_array($data))
	{
		$ans=$row['answer'];
		break;
	}

if ($ans==$opt)
{
	$u=1;
	$flagc=1;
}
else
{
	$u=0;
	$flagi=1;
}
$count=0;
$theta=0;
$d=array(-2.5,-1.25,0,1.25,2.5);

$diff = mysql_query("SELECT * FROM questionbank where qid=$id");

while($row1= mysql_fetch_array($diff))
{
$d2=$row1['difficulty'];
$tp=$row1['tid'];
break;
}
$topic_ids=array();
$ret = mysql_query("SELECT * FROM topic where sid=$sid order by tid");
$no_topics=mysql_num_rows($ret);
$ctr=0;
while($row2= mysql_fetch_array($ret))
{
$topic_ids[$ctr]=$row2['tid'];
$ctr=$ctr+1;
}
$pos=0;
for($j=0;$j<$ctr;$j=$j+1)
{
	if($topic_ids[$j]==$tp)
		$pos=$j;
}
$ct[$pos]=$ct[$pos]+1;



$p=prob($d2,0);

$pd=prob1($d2,0);

$i=iif($p,$pd);



$st=stheta($u,$p,$pd);
$tn=tnext($st,$i,0);
if($tn>=-3 && $tn<=3)
	$t=$tn;
else
	echo '
<script type="text/javascript">
<!--
window.location = "score.php"
//-->
</script>';


$selp=0;
$selpd=0;
$sums=$st;
$sumi=$i;
$maxi=0;

$v[]=$id;
$vis=join(",",$v);

$d=array(-2.5,-1.25,0,1.25,2.5);
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
	$topicp[$j]=($dq[$j]-$ct[$j])/24;
}
for ($j=0; $j<=4; $j++)
{
	$difference[$j]=$maxi-$iif1[$j];
}
$min=999;
for ($j=0; $j<=4; $j++)
{
	for ($z=0; $z<$no_topics; $z++)
	{
		$pen[$j][$z]=$difference[$j]-$topicp[$z];
		if($pen[$j][$z]<$min)
		{
			$min=$pen[$j][$z];
			$selj=$j;
			$selz=$z;
			$seld=$d[$j];
			$selt=$topic_ids[$z];
			$selp=$p1[$j];
			$selpd=$pd1[$j];
			$seli=$iif1[$j];
		}
	}
}

$qn="q1";
$pv=array();
$pv[$selj][$selz]=1;
while(true)
{
	$flag=0;
	while($flag==0)
	{
	$min1=999;
$qs="SELECT * FROM questionbank where difficulty=$seld and sid=$sid and tid=$selt and qid not in (".$vis.") order by rand()";

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
				$selj=$j;
				$selz=$z;
				$seld=$d[$j];
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
	while($row3= mysql_fetch_array($nextq))
	{
		$qid=$row3['qid'];
		$q=$row3['question'];
		$o1=$row3['choice1'];
		$o2=$row3['choice2'];
		$o3=$row3['choice3'];
		$o4=$row3['choice4'];
		$d1=$row3['difficulty'];
		break;
	}
	$check=mysql_query("SELECT $qn FROM test where testid=$tid1")or die(mysql_error());
while($row4= mysql_fetch_array($check))
	{
		$check1=$row4[$qn];
		break;
	}

	while($qid!=$check1 && !is_null($check1))
	{
		$k=$k+1;
		$qn="q".$k;
	$check=mysql_query("SELECT $qn FROM test where testid=$tid1")or die(mysql_error());
while($row5= mysql_fetch_array($check))
	{
		$check1=$row5[$qn];
		break;
	}

	
	}
	if(is_null($check1))
	break;

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
$_SESSION['t']=$t;
$_SESSION['sumi']=$sumi;
$_SESSION['sums']=$sums;
$_SESSION['seli']=$seli;
$_SESSION['selp']=$selp;
$_SESSION['selpd']=$selpd;
$_SESSION['dq']=$dq;
$_SESSION['ct']=$ct;
$_SESSION['v']=$v;
$_SESSION['topic_ids']=$topic_ids;
$_SESSION['no_topics']=$no_topics;
$_SESSION['sid']=$sid;
$_SESSION['vis']=$vis;

echo '
<script type="text/javascript">
<!--
window.location = "nq.php"
//-->
</script>';
?>

<?php
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
	$tn=$t+($st*0.135/$i);
	return $tn;
}

?>