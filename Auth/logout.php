<?php

session_start();

//Unset all session variables
$_SESSION = [];

//Destroy the session
session_destroy();

//Delete the session cookie
setcookie ("PHPSESSID", "", time() - 3600, "/");

//Redirect to login page
header("Location: login.php");
exit();
?>
