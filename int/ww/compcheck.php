



<?php
//version 1.3
session_start();
if ($_SESSION['Company'] == 'NNB'){
}
else
{
    header('Location: https://demo.darbus.co.uk/int/ww/notnnb.php'); // Redirecting To Home Page
}
?>