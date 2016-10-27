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
echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>Welcome : </b>";echo $_SESSION['studentname'] ;echo "</td></tr>";
echo "</table>";

$q=mysql_query("select * from subjects order by sid");

echo '
<fieldset>
<legend>Select A Subject</legend>
<form name="selectsubject" method="post" action="question.php">
<table>
<tr><td><b>Available Subject List</b></td>
<td><select name="sid">';

while($row=mysql_fetch_array($q))
{
echo "<option value=";echo $row['sid'];echo ">"; 
echo $row['section']; echo "</option>";
}
echo '


</select></td>

</tr>
<tr></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Start Test"></td></tr>
<input type="hidden" name="difficulty" value="0">
</table>
</form>
</fieldset>
';
?>
