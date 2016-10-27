<?PHP

include "session.php";
require "../config.php";

require "check.php";

session_destroy();

header('Location: index.php');
?>