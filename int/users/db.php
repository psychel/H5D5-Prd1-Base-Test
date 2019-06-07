<?php include "../inc/cdbinfo.inc"; ?>

<?php
//Database connection.
/* Connect to MySQL and select the database. */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($con, DB_DATABASE);
?>