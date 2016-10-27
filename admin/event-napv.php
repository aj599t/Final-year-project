<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Not Approved</title>
</head>
<?php
include ('style.php');
?>

<body >
<?php

require "check.php";
require "menu.php";

@$msg=$_GET['msg'];
if(isset($msg) and strlen($msg) >1 ){
echo "<span style='background-color: #FFFF00'>$msg</span>";
}

////////////////////////////////////////////////////////////////////////////////////////////

$q=mysql_query("select * from iam_event where status = 'ns' order by event_id desc");

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
while($nt=mysql_fetch_array($q)){
echo "<tr bgcolor='#f1f1f1'><td><b>id</b>:$nt[event_id] <b>Event name</b>:$nt[event_name]  <b>status</b>:$nt[status] <a href='event-dtl.php?event_id=$nt[event_id]&f_name=event-napv.php'>Details</a></td></tr>";
echo "<tr ><td colspan=2>$nt[dtl]</td></tr>";

}
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////  
?>
</body>
</html>
