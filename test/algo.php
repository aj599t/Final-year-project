<?php
include "session.php";
require "../config.php";
require "check.php";

?>

<?php
$id=$_POST[id];
//$id=2;
$opt=$_POST[option];
$dq=array(3,3,3,3,3,9);
$ct=array(0,0,0,0,0,0);
$p1=array();
$pd1=array();
$iif1=array();
$topicp=array();
$difference=array();
$_SESSION['dq']=$dq;
$_SESSION['ct']=$ct;

$ins="INSERT INTO test (testid, uid, sid, q1,a1)
VALUES
(NULL,1,1,'$_POST[id]','$_POST[option]')";
mysql_query($ins);
$tid1=mysql_insert_id();

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
/*
echo "yash";		
$r=2;
while($flagi==0 || $flagc==0)
			{
			$count++;
			if($u==0)
			{
				if($theta!=-2)
				{
				$theta--;
				$l--;
				}
			//	flagi=1;
			
			}
			else
			{
				if($theta!=2)
				{
				$theta++;
				$r++;
								
				}
			//	flagc=1;
			}
		
			if($flagi==1 && $flagc==1)
				break;
			
			
			$data = mysql_query("SELECT * FROM questionbank where difficulty=$d[$r] and sid=$sid order by rand()") 
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
echo "Question No: ".$count;


			if($u==0)
				$flagi=1;
			else
				$flagc=1;
			}
*/
//ankita commented

$diff = mysql_query("SELECT * FROM questionbank where qid=$id");

while($row1= mysql_fetch_array($diff))
{
$d2=$row1['difficulty'];
$tp=$row1['tid'];
break;
}
$topic_ids=array();
$ret = mysql_query("SELECT * FROM topic where sid=1");
$no_topics=mysql_num_rows($ret);
$ctr=0;
while($row2= mysql_fetch_array($ret))
{
$topic_ids[$ctr]=$row2['tid'];
$ctr=$ctr+1;
}

for($j=0;$j<$ctr;$j=$j+1)
{
	if($topic_ids[$j]==$tp)
		$pos=$j;
}
$ct[$pos]=$ct[$pos]+1;



$p=prob($d2,0);

$pd=prob1($d2,0);

$i=iif($p,$pd);
//$iif1[2]=$i;


$st=stheta($u,$p,$pd);
$tn=tnext($st,$i,0);
$t=$tn;


//echo $t." ";
$selp=0;
$selpd=0;
$sums=$st;
$sumi=$i;
$maxi=0;
$v=array();
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
		//$selp=$p;
		//$selpd=$pd;
		$maxdiff=$d[$j];
	}

}
for ($j=0; $j<$no_topics; $j++)
{
	$topicp[$j]=($dq[$j]-$ct[$j])/14;
	///echo "topicp ".$topicp[$j];
	$difference[$j]=$maxi-$iif1[$j];
	//echo "difference ".$difference[$j];
}
$min=999;
for ($j=0; $j<=4; $j++)
{
	for ($z=0; $z<$no_topics; $z++)
	{
		$pen[$j][$z]=$difference[$j]-$topicp[$z];
	//	echo "pen ".$pen[$j][$z];
		//echo "j ".$j;
		//echo "z".$z;
		//echo "min".$min;
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
	echo "selt: ".$selt;
$qn="q1";
//echo "seld".$seld;
//echo "selp".$selt;
//echo $maxdiff;
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
			if($pen[$j][$z]<$min1 && $pen[$j][$z]>$min)
			{
				$min1=$pen[$j][$z];
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
//echo $qid." Difficulty:".$d1." Topic:".$selt;
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
//		echo $qn;
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
echo '
<script type="text/javascript">
<!--
window.location = "nq.php"
//-->
</script>';
?>

<?php
//echo "qid".$qid;
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

?>