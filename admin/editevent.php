<?php
include "session.php";
require "../config.php";
?>
<?php
if(isset($_POST['submit'])){
	$area=$_REQUEST['event'];
//echo $area;
	$fd=fopen("event.txt","w+");
	fwrite($fd,$area);
	fclose($fd);
	//$file_contents=file_get_contents("event.txt");
	//print $file_contents;
        echo '<script>window.location=("event.php")</script>';
}
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Events</title>
<style type="text/css">
#event{
width:900px;
margin:20px auto;
padding: 2px 2px 2px 2px;
background-color: silver ;
opacity:.70;
filter: alpha(opacity=70); 
-moz-opacity: 0.7; 
border:2px solid black; 

}

</style>
</head>
<?php
include ('style.php');
?>

<body >
<?php

require "check.php";
require "menu.php";


$fn="event.txt";
$file = fopen($fn, "r+");
$size=filesize($fn);
$text = fread($file, $size);


echo "Edit and update all the events you want to be displayed on the website";

echo '<p><a href="event.php">Click Here to Cancel the editing of Events Text</a></p>';

echo '<div id="event"><form method="post" action="editevent.php" ><textarea rows="30" cols="109" name="event" >';
//include "../event.txt";
echo "$text";

echo '</textarea><input type="submit" name="submit" value="Click Here to Save the Events Text">
</form></div> ';
?>
