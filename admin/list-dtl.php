<?php
include "session.php";
require "../config.php";
?>

<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>(Type a title for your page here)</title>
<link rel="stylesheet" href="images/all11.css" type="text/css">
<?php
include ('style.php');
?>

</head>

<body >  
<?php

require "check.php";
require "menu.php";

////////////////////////////////////////////////////////////////////////////////////////////
$post_id=$_GET['post_id'];
$f_name=$_GET['f_name'];
$q=mysql_query("select * from iam_post where post_id=$post_id ");
echo mysql_error();
$row=mysql_fetch_object($q);
$editable=$_GET['editable'];

echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr bgcolor='#f1f1f1'><td><b>id</b>:$row->post_id <b>status</b>:$row->status</td><td>".date("d-m-Y",strtotime($row->dt))."</td><td align=right>:$row->time</td></tr>";

if($editable=="")
{
	echo "<tr ><td colspan=2>$row->dtl</td></tr>";
	echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=1\">Edit Text</a></td></tr>";
	echo $row->image;

	if($row->image<>"")
	{	
		echo "<tr><td><img src='../uploads/".$row->image."' class='preview'></td></tr>";
		echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=3\">Cancel Image</a></td></tr>";
	}

}
else
{	
	if($editable=="1")
	{
		
	echo '<form action="list-dtl.php" method="get">';
	echo "<input type=hidden name=f_name value='$f_name'>";
	echo "<input type=hidden name=post_id value=$post_id>";
	echo "<input type=hidden name=editable value=2>";
	
	echo "<tr ><td colspan=2><textarea name=\"text1\" rows=\"20\" cols=\"100\">$row->dtl</textarea></td></tr>";
		
	echo "<tr><td><input type=\"submit\" /></td><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php\">Cancel</a></td></tr>";
	echo '</form>';

	}


	else
	{	
		if($editable=="2")
		{
	
		$text1=$_GET['text1'];
		$q1=mysql_query("update  iam_post set dtl='$text1' where post_id=$post_id ");
		echo mysql_error();
	
		$q=mysql_query("select * from iam_post where post_id=$post_id ");
		echo mysql_error();
		$row=mysql_fetch_object($q);


		echo "<tr ><td colspan=2>$row->dtl</td></tr>";
		echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=1\">Edit Text</a></td></tr>";
		if($row->image<>"")
	{	
		echo "<tr><td><img src='../uploads/".$row->image."' class='preview'></td></tr>";
		echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=3\">Cancel Image</a></td></tr>";
	}
}

		else
		{

			$q1=mysql_query("update  iam_post set image='' where post_id=$post_id ");
			echo mysql_error();
		
			$q=mysql_query("select * from iam_post where post_id=$post_id ");
			echo mysql_error();
			$row=mysql_fetch_object($q);


			echo "<tr ><td colspan=2>$row->dtl</td></tr>";
			echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=1\">Edit Text</a></td></tr>";
			if($row->image<>"")
	{	
		echo "<tr><td><img src='../uploads/".$row->image."' class='preview'></td></tr>";
		echo "<tr><td><a href=\"list-dtl.php?post_id=$post_id&f_name=list.php&editable=3\">Cancel Image</a></td></tr>";
	}

		}
	}
}
echo "</table>";
echo "<hr>";
//////////////////////////////////////////////////////////////////////////////////////////////  

//////////// Updation starts ////////////////////

switch($row->status)
{
case "ns":
$nsck="checked";
$apvck="";

break;

case "apv":
$apvck="checked";
$nsck="";

break;


default:
$apvck="";
$nsck="";
break;

}


echo "<form method=post action='list-dtlck.php'><input type=hidden name='todo' value='status-up'><input type=hidden name=f_name value='$f_name'>
<input type=hidden name=post_id value=$post_id>
<input type=radio name=status value='ns' $nsck>Not Seen <input type=radio name=status value='apv' $apvck>Approved 
<input type=radio name=status value='del' >Delete 

<input type=submit value='Update'> 


</form>
";
///////////Updation ends ////////////////////////
?>
</body>
</html>
