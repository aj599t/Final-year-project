<?php
include "session.php";
require "../config.php";
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
//echo "$text";
echo "Edit and update all the events you want to be displayed on the website";

echo '<p><a href="editevent.php">Click Here to Edit the Events Text</a></p>';

echo '<div id="event"><textarea rows="35" cols="109" style="background-color:transparent;" readonly>';
//include "../event.txt";
echo "$text";

echo '</textarea></div> ';
?>
