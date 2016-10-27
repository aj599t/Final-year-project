<?php
include "session.php";
require "../config.php";
?>


<?php
$post_id=$_GET['post_id'];
echo $post_id;

$q=mysql_query("select * from iam_post where post_id=$post_id ");
echo mysql_error();
$row=mysql_fetch_object($q);
echo "<textarea>$row->dtl</textarea>";


?>