<?php
$body="
<form name='f1' action='uservalidate.php' method='post'>
<table border='0' cellspacing='0' cellpadding='0' align=center>
<tr>
<td  class='data'> Login ID  &nbsp; &nbsp;</td> 
<td ><input type ='text' class='bginput' name='studentlogin' ></font></td>
</tr>
<tr>
<td  class='data'>  &nbsp;Password  </td>
<td  ><input type='password' class='bginput' name='password' ></td>
</tr>
<tr> 
<td  colspan='2' align=center ><input type='submit' value='Submit'> <input type='reset' value='Reset'></td> 
</tr>
</table>
</center>
</form>";


echo $body;

?>