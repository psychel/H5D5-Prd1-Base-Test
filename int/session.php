<?php include "inc/cdbinfo.inc";  ?>

<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// error if not connecting to DB

if (mysqli_connect_errno()) echo "Failed to connect to MySQL on session: " . mysqli_connect_error();
// Selecting Database
$db = mysqli_select_db($connection, DB_DATABASE);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "select username from login where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
//echo implode($row);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: log.php'); // Redirecting To Home Page
}
?>
