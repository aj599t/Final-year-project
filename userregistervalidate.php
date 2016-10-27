<?php
require "config.php";
?>
<?php
$name=$_POST['name'];
$name=mysql_real_escape_string($name);

$username=$_POST['username'];
$username=mysql_real_escape_string($username);

$password=$_POST['password'];
$password=mysql_real_escape_string($password);

$emailid=$_POST['emailid'];
$emailid=mysql_real_escape_string($emailid);

$contactno=$_POST['contactno'];
$contactno=mysql_real_escape_string($contactno);

$address=$_POST['address'];
$address=mysql_real_escape_string($address);

$status="ns";
$date=date("d-m-Y");

$q=mysql_query("insert into students (studentlogin,password,email_id,contact,address,date,studentname,status) values ('$username','$password','$emailid','$contactno','$address','$date','$name','$status')");
if(mysql_affected_rows() <> 1)
{
echo "X";
}
else
{
echo "Y";
}

?>
