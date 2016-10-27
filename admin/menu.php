<?php

echo "Welcome ";
echo $_SESSION['username'] ;
echo "<br />";


if($_SESSION['userlevel']==1)
{


	echo "<a href=allusers.php>All Users</a> | <a href=allsubjects.php>All Subjects</a> | <a href=alltopics.php>All Topics</a> | <a href=allstudents.php>All Students</a> | <a href=allquestions.php>All Questions</a> | <a href=allquestions-ns.php>Questions Not Seen</a> | <a href=allquestions-apv.php>Questions Approved</a> | <a href=questionentry.php>Questions Entry</a> | <a href=logout.php>Logout</a>  
<br>";
}
else if($_SESSION['userlevel']==2)
{
	echo "<a href=allusers.php>All Users</a> | <a href=allsubjects.php>All Subjects</a> | <a href=sub-alltopic.php>All Topics</a> | <a href=allstudents.php>All Students</a> | <a href=sub-questions.php>Questions</a> | <a href=logout.php>Logout</a>
	
<br>";
}
else if($_SESSION['userlevel']==3)
{
echo	"<a href=question-add.php>Question Entry</a> | <a href=logout.php>Logout</a> 
<br>";
}
else 
{
echo '<a href="index.php">Click Here To Login </a>';
}
?>