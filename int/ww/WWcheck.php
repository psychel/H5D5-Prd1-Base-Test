
<?php
//version 1.3
session_start();
if ($_SESSION['WW'] == 'Yes'){
}
else
{


    header('Location: https://demo.darbus.co.uk/int/ww/noww.php'); // Redirecting To Home Page
}
?>