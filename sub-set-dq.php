<?php
require "config.php";
?>

<html>
<body>
<?php
$q=mysql_query("select * from subjects order by sid");
echo '
<fieldset>
<legend>Select A Subject</legend>
<form name="selectsubject" method="post" action="set-dq.php">
<table>
<tr><td><b>Available Subject List</b></td>
<td><select name="sid">';

while($row=mysql_fetch_array($q))
{
echo "<option value=";echo $row['sid'];echo ">"; 
echo $row['section']; echo "</option>";
}
echo '
</select></td></tr>
<tr></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Submit"></td></tr>
</table>
</form>
</fieldset>
';
?>
</body>
</html>
