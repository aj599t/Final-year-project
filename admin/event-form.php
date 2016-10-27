<div id="dispabsolute">
<div id="contact" style="background:white;">
	<br /><br />
<?php


echo '<div id="contact_header" style="color:black;font-family:arial;">Post About Your Event</div>';
echo '<div><form id="imageform" method="post" enctype="multipart/form-data" action=\'ajaximage.php\'>
<font color="black">Select image </font><input type="file" name="photoimg" id="photoimg" />
</form>
<div id=\'preview\'>
</div>
</div>';

echo '<table width="400" border="0" cellspacing="1" cellpadding="0" id="tutu">
<form id="contor" method="post" action="" ><input type=hidden name=todo value=post_comment>
<tr><td>Write About Event <font color="red">(max 300 char.)</font></td><td><textarea name=dtl rows=3 cols=50 id="dtl"></textarea></td></tr>
<tr ><td colspan=2 align=center><input type=submit value="Post Event Detail"></td></tr>
</table></form>';


?>
<?php

@$todo=$_POST['todo'];
if(isset($todo) and $todo=="post_comment"){

//$name=$_POST['name'];
//$name=mysql_real_escape_string($name);
//$email=$_POST['email'];
//$email=mysql_real_escape_string($email);
$dtl=$_POST['dtl'];
$dtl=mysql_real_escape_string($dtl);

$status = "OK";
$msg="";

// if userid is less than 3 char then status is not ok
//if( strlen($name) <3 or strlen($name) > 25){
//$msg=$msg."Your Name  should be more than 2 and less than 25 char length<BR>";
//$status= "NOTOK";}					
	
if( strlen($dtl) <3 ){
$msg=$msg."Your Event Detail should be more than 3 char length<BR>";
$status= "NOTOK";}					



if($status<>"OK"){
 
echo "<font face='Verdana' size='2' color=red>$msg</font>";

  echo "<script> 

		$('html, body').animate({scrollTop:0}, 'fast');

		// before showing the modal window, reset the form incase of previous use.
		$('.success, .error').hide();
		$('form#contactForm').show();
		
		$('#dtl').val('');

		//show the mask and contact divs
		$('#mask').show().fadeTo('', 0.7);
		$('div#contact').fadeIn();


</script>"; 

}else{ // if all validations are passed.

$dt=date("Y-m-d");
$time=date("h:i:s"); 
$status='apv'; // Change this to apv if you want all messages to be automatically approved once posted.

$image=$_SESSION['imagename'];

//echo $image;

$query=mysql_query("insert into iam_event(dtl,image,status) values('$dtl','$image','$status')");
echo mysql_error();
echo'<div id="message">';
echo "<font face='Verdana' size='2' color=green>Thank you for posting your Event Detail<br></font>";
echo'</div>';

echo "<script> 

		$('html, body').animate({scrollTop:0}, 'fast');

		
		$('#dtl').val('');

		//show the mask and contact divs
		
		$('form#contor').hide();
		$('form#imageform').hide();
		$('div#contact_header').hide();
		$('table#tutu').hide();
$('#mask').show().fadeTo('', 0.7);
		$('div#contact').fadeIn();

</script>"; 

}
}// Checking of if condition if form is submittted

?>
</div>
<div id="mask"></div>
</div>