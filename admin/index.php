<?php
include "session.php";
require "../config.php";
?>

<html>
<head>
<title>Administrator Login</title>
</head>

<?php
include ('style.php');
?>

<body  TOPMARGIN='0' onLoad="document.f1.id.focus()">

<?php

$hd="Log In Here..";

$body="<form name='f1' action='loginck.php' method=post>
<table border='0' cellspacing='0' cellpadding='0' align=center>
  <tr id='cat'>
  <tr> <td  class='data'> &nbsp;Login ID  &nbsp; &nbsp;
</td> <td ><input type ='text' class='bginput' name='id' ></font></td></tr>
<tr> <td  class='data'>  &nbsp;Password  
</td> <td  ><input type ='password' class='bginput' name='pw' ></td></tr>

<tr> <td  colspan='2' align=center ><input type='submit' value='Submit'> <input type='reset' value='Reset'>
</td> </tr>

</table></center></form>";

echo $body;

  
?>
</body>
</html>


