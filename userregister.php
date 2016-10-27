<html>
<head>
<title>Student Register Screen</title>
</head>
<body>

<script>
function val_userregister()
{
a=val_name();

b=val_username();

c=val_password();

d=val_emailid();

e=val_contact();

f=val_address();

if(a==false || b==false || c==false || d==false || e==false || f==false )
return false;
else
return true;
}
function val_name()
{
document.getElementById('error1').style.display="none";
if(document.userregister.name.value.length<3)
{
document.getElementById('error1').style.display="";
return false;
}
return true;
}

function val_username()
{
document.getElementById('error2').style.display="none";
if(document.userregister.username.value.length<3)
{
document.getElementById('error2').style.display="";
return false;
}
return true;
}
function val_password()
{
document.getElementById('error3').style.display="none";
if(document.userregister.password.value.length<6)
{
document.getElementById('error3').style.display="";
return false;
}
return true;
}

function val_emailid()
{
document.getElementById('error4').style.display="none";
if(document.userregister.emailid.value.length<3)
{
document.getElementById('error4').style.display="";
return false;
}
return true;
}

function val_contact()
{
document.getElementById('error5').style.display="none";
if(document.userregister.contactno.value.length<9)
{
document.getElementById('error5').style.display="";
return false;
}
return true;
}

function val_address()
{
document.getElementById('error6').style.display="none";
if(document.userregister.address.value.length<7)
{
document.getElementById('error6').style.display="";
return false;
}
return true;
}
</script>
<fieldset>
<legend>Student Details</legend>
<form name="userregister" method="post" action="userregistervalidate.php" onsubmit="return val_userregister();">
<table>
<tr>
<td>Student Name</td>
<td><input type="text" width="50" name="name" onkeyup="val_name();"></td>
</tr>

<tr>
<td colspan="2"><div id="error1" style="color:red;display:none;">Name >3 Chars</div></td>
</tr>


<tr>
<td>Username</td>
<td><input type="text" width="50" name="username" onkeyup="val_username();"></td>
</tr>

<tr>
<td colspan="2"><div id="error2" style="color:red;display:none;">UserName >3 Chars</div></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" width="50" name="password" onkeyup="val_password();"></td>
</tr>

<tr>
<td colspan="2"><div id="error3" style="color:red;display:none;">Password >6 Chars</div></td>
</tr>

<tr>
<td>Email Id</td>
<td><input type="text" width="50" name="emailid" onkeyup="val_emailid();"></td>
</tr>

<tr>
<td colspan="2"><div id="error4" style="color:red;display:none;">Enter Valid Email ID</div></td>
</tr>

<tr>
<td>Contact No.</td>
<td><input type="text" width="50" name="contactno" onkeyup="val_contact();"></td>
</tr>

<tr>
<td colspan="2"><div id="error5" style="color:red;display:none;">Telephone >8 Numbers</div></td>
</tr>

<tr>
<td>Address</td>
<td><textarea  name="address" onkeyup="val_address();"></textarea></td>
</tr>

<tr>
<td colspan="2"><div id="error6" style="color:red;display:none;">Address > 6 Chars</div></td>
</tr>

<tr>
<td colspan="2"><input type="Submit"  value="Register"></td>
</tr>

</table>
</form>
</fieldset>
</body>