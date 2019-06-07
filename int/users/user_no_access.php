
<?php

//version 1.3
session_start();
if ($_SESSION['group'] == 'Admin'){
}
elseif ($_SESSION['WWadmin'] == 'Yes'){}



else
{ header('Location: https://demo.darbus.co.uk/int/users/noaccess.php');exit; // Redirecting To Home Page
}


?>