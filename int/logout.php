<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: log.php"); // Redirecting To Home Page
}
?>
