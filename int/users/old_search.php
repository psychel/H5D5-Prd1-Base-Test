<?PHP
include "user_no_access.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Live Search using AJAX</title>
    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript" src="script.js"></script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>



<body>
<h1>Welcome to the User Administration page here</h1>

<br>

<a href="../main.php">Click here to goto the Main Page</a>
<br>
<a href="../admin.php">Click here to go back to admin page</a>


<br>
<h1> User management</h1>
<p> Enter any of the details of the person to search for in the box. Place a '%' in the box to see all users.</p>
<!-- Search box. -->
<input type="text" id="search" placeholder="Start typing the details or put a '%' to see all." />
<br>
<b>Ex: </b><i>David, Ricky, Ronaldo, Messi, Watson, Robot</i>
<br />
<!-- Suggestions will be displayed in below div. -->
<div id="display"></div>
</body>
</html>

<?php
include "../foot.php";
?>
