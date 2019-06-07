<!DOCTYPE html>
<html>
<head>
    <title>Integrated App user configuration</title>
    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript" src="script.js"></script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<!-- Search box. -->
<h1>Welcome to the User Administration page </h1>

<br>

<a href="../main.php">Click here to goto the Main Page</a>
<br>
<a href="../admin.php">Click here to go back to admin page</a>


<br>
<h1> User management</h1>
<p> Enter any of the details of the person to search for in the box.</p>
<input type="text" id="search" style='height:20px;width:400px;'  placeholder="Search" />
<br>
<b>Ex: </b><i>First name, surname, company, username</i>
<br />

<!-- Suggestions will be displayed in below div. -->
<div id="display"></div>
</body>
</html>