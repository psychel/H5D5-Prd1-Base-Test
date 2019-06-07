
<?php
//version 1.3
session_start();
if ($_SESSION['WWadmin'] == 'Yes'){
}
else
{
    header('Location: nowwadmin.php'); // Redirecting To Home Page
}
?>