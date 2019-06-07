
<?php

//version 1.3
session_start();
if ($_SESSION['group'] == 'Admin'){
}
else
{ header('Location: nodl.php');exit; // Redirecting To Home Page
}


?>