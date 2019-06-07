<?php include "../inc/cdbinfo.inc"; ?>
<style>
<?php include "../admincheck.php"; include "../style.css";


?></style>
<html>
<body>
<h1>Welcome to the  User Administration page</h1>


<a href="../main.php">Click here to goto the Main Page</a><p></p>
<a href="../admin.php">Click here to go back to the Admin page</a>

<h1> Add a new user </h1>


<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the Monday table. */
 if(isset($_POST['add']))
     {
            $fullname   = $_SESSION['fullname'];
	        $username   = htmlentities($_POST['newuser']);
	        $newpass    = htmlentities($_POST['newpass']);
            $newemail   = htmlentities($_POST['newemail']);
            $newgroup   = htmlentities($_POST['newgroup']);
            $first      = htmlentities($_POST['first']);
            $last       = htmlentities($_POST['last']);
            $Company    = htmlentities($_POST['Company']);

            $result = mysqli_query($connection,"SELECT * FROM login WHERE username='" . $username . "' ");
            $row  = mysqli_fetch_array($result);
            if(empty($row))
                {
                if (strlen($username))
                    {
                    AddUser($connection, $username, $newpass,$newemail,$newgroup,$first,$last,$Company,$fullname);
/*		header('Location: '.$_SERVER["PHP_SELF"], true, 303); */
                    }
                }
      }else
                {
                echo 'User already exists and therefore was not added to the database.';
                }

$user=$_GET['user'];
$cemail = $_GET['cemail'];
//get the post data from search page
$ID = $_GET['ID'];

?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'];
$fullname   = $_SESSION['fullname'];
?>" method="POST">
  <table border="0">

		<tr>
		<td>

                    <h2>	Please enter new user details <?PHP echo "user " .$fullname ?></PHP></h2></td>  </tr><tr>
                    <td><p>Username</td><td>	<input type="text" name="newuser" maxlength="45" size="40" /></p></td></tr>
                <td><p>First Name</td><td><input type="text" name="first" maxlength="45" size="40" /></p></td></tr>
                <td><p>Last Name</td><td><input type="text" name="last" maxlength="45" size="40" /></p></td></tr>

      <tr>     <td><p>Company</td><td>           <?PHP
              $res = mysqli_query($connection,
                  "select distinct (ContractorName)
                                    from contractors 
                                  " );

              if(mysqli_num_rows($res)){
                  $select= '<select name="Company" onchange=\"reload(this.form)\">';
                  $select.= " <option value=''>Select</option>";
                  while($rs=mysqli_fetch_array($res)){
                      if($rs['ContractorName']!=''){
                          $select .= '<option value="' . $rs['ContractorName'] . '" ';
                          if ($_POST['Company'] == $rs['ContractorName']) {
                              $select .= ' selected = "selected"';
                          }
                          $select .= '>' . $rs['ContractorName'] . '</option>';
                      }
                  }
              }
              $select.='</select>';
              echo $select;

              ?></td>



      <tr>    <td>	<p>Password</td><td>	<input type="text"  readonly name="newpass" maxlength="45" size="40" value="pass"/></p></td></tr>
                <tr><td>    <p>Email address</td><td><input type="text" name="newemail" maxlength="45" size="40" /></p></td></tr>
                <tr><td>    <p>Group access rights</td><td>                    <select id="newgroup" name="newgroup">
                            <option value="user">Select Status for group</option>
                            <option value="user">user</option>
                            <option value="Admin">Administrator</option>
                            <option value="view">Viewer</option></p></td></tr>
                <tr></tr><td></td><tr><td></td><td>	<input type="submit" name="add" value="Add new user" />
                </td></tr>
  
  </table>
   
<!-- Display table data. -->


<!-- Clean up. -->
<?php
/*
  mysqli_free_result($result);
  mysqli_close($connection);
*/
?>

</body>
</html>
<?php

	/* Insert user */

	function AddUser($connection, $newuser, $newpass,$newemail,$newgroup,$first,$last,$Company,$fullnam){
		$u = mysqli_real_escape_string($connection, $newuser);
		$p = mysqli_real_escape_string($connection, $newpass);
		$e = mysqli_real_escape_string($connection, $newemail);
		$g = mysqli_real_escape_string($connection, $newgroup);
		$f = mysqli_real_escape_string($connection, $first);
		$l = mysqli_real_escape_string($connection, $last);
		$c= mysqli_real_escape_string($connection, $Company);
		$a = mysqli_real_escape_string($connection, $fullnam);
		    $VarCodeQuery = "insert into login (
                            login.username, 
                            login.password,
                            login.email,
                            login.group,
                            login.first,
                            login.last,
                            login.Company,
                            login.Addedby) "
                        . "values ('$u' , 
                        '$p',
                        '$e',
                        '$g',
                        '$f',
                        '$l',
                        '$c',
                        '$a');";

echo ("The user $u has been added");
		if(!mysqli_query($connection, $VarCodeQuery)) echo("<p>Error updating Variance code.</p>");

	}

	
?>
