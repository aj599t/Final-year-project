<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title></title><meta name="viewport" content="width=400" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<?php

require "check.php";
//require "menu.php";


@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";}

///////////////////////////////////////////////////

$theta= $_SESSION['t'];
$error= $_SESSION['se'];
$tid1=$_SESSION['id2'];
$sid=$_SESSION['sid'];
$k=$_SESSION['k'];
//echo $k;
$k=$k-1;
$score=(($theta+3)*100/6)+20;
if($theta==3)
	$score=$score+(1.25*(25-$k));
if($theta==-3)
	$score=$score-(1.25*(25-$k));

$score=round($score);

mysql_query("UPDATE test SET score= '$score'  
WHERE testid = '$tid1'") or die(mysql_error()); 

$s=mysql_fetch_array(mysql_query("select * from subjects where sid='$sid'"));

//echo "theta: ".$theta;
//echo "error: ".$error;
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
<?php echo "<h1 align=center>Score: ".$score."</h1>"; ?>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="http://localhost/beray1/admin/score1.php" data-send="true" data-width="450" data-show-faces="true"></div>


<div id="footer">
<a href="sel-review-test.php?testid= <?php echo $tid1 ?> ">Review test</a>
<a href="#">Main Menu</a>
</div>



</body>
</html>