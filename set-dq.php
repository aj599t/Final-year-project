<?php
require "config.php";
?>


<html>
<body>

<?php
$sid=$_POST['sid'];
$q=mysql_query("select * from topic where sid=$sid order by sid");

echo '
<fieldset>
<legend>Set Desirable Number of Questions</legend>
<form name="topicset" method="post" action="dq-db.php">
<table><tr><td colspan=2>Total Number of Questions in Test : 25<br/><br/></td></tr>';

while($t=mysql_fetch_array($q))
{
echo '<tr><td>'.$t['tname'].'<td><input type="text" size=2 name="'.$t['tid'].'"></input></td></tr>';
}
echo '
<input type="hidden" name="sid" value="'.$sid.'"/>
<tr><td colspan="2" align="center"><input type="submit" value="Submit"></td></tr>
</table>
</form>
</fieldset>
';
?>
</body>
</html>
