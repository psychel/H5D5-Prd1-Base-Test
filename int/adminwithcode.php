<?php include "../../inc/cdbinfo.inc"; ?>
<?php include "admincheck.php"; ?>
<html>
<body>
<h1>Welcome to the Administration page for Users</h1>

<br></br>
<a href="del.php">Click here if you wish to Delete Activities</a>
<br></br>
<a href="main.php">Click here to goto the Main Page</a>
<br></br>
<a href="import.php">Click here to import data</a>

<br></br>
<a href="add.php">Click here to add a single line to the database</a>
<br></br>
<h1> User management</h1>
<br></br>
<input type="submit" value="Add New User" name="Add" />
<input type="submit" value="Change User Details" name="change" />

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

 
 if(isset($_POST['cgroup'])){ 
  
//echo ("username: ".$_POST['gusername']." Group :" .$_POST['group1']);
$gusername = htmlentities($_POST['gusername']);
  $group1 = htmlentities($_POST['group1']);
echo ("Changed username: " . $gusername . " to group: ".$group1);

	if (strlen($gusername)) {
//	echo ("going");
    		UpdateGroup($connection, $gusername,  $group1);
	 //	header('Location: '.$_SERVER["PHP_SELF"], true, 303);   
	}
  }
else if(isset($_POST['add'])){
//	echo ("Username " .$_POST['newuser'] . "Password : " . $_POST['newpass']);
	$username = htmlentities($_POST['newuser']);
	$newpass = htmlentities($_POST['newpass']);
        $newemail = htmlentities($_POST['newemail']);
        $newgroup = htmlentities($_POST['newgroup']);
        
	if (strlen($username)){
		AddUser($connection, $username, $newpass,$newemail,$newgroup);
/*		header('Location: '.$_SERVER["PHP_SELF"], true, 303); */
	}
}
else if(isset($_POST['del'])){
	$deluser = htmlentities($_POST['deluser']);
	if (strlen($deluser)){
		DelUser($connection, $deluser);
	}
}
else if (isset($_POST['cpass'])){
	$resetuser = htmlentities($_POST['resetuser']);
	$resetpass = htmlentities($_POST['resetpass']);
	if (strlen($resetuser)){
		CPass($connection, $resetuser, $resetpass);
	}
}
else if (isset($_POST['c-email'])){
        $user1 =$_POST['user']; 
	$cemail = htmlentities($_POST['cemail']);
        $ID = htmlentities($_POST['ID']);
        Cemail($connection, $cemail, $ID,$user1);


	
}



$user=$_GET['user'];
$cemail = $_GET['cemail'];
$ID = $_GET['ID'];
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
      <tr>
          <td>
              
          </td>
          <td>Username</td>
          <td>Password</td>
          <td>Email</td>
          <td>Group</td>
      </tr>
    <tr>
		<tr>
		<td>
		<p>	Please enter new user details</p></td><td>
			<input type="text" name="newuser" maxlength="45" size="40" /></td><td>
			<input type="text" name="newpass" maxlength="45" size="40" /></td><td>
                        <input type="text" name="newemail" maxlength="45" size="40" /></td><td>
                        <select id="newgroup" name="newgroup">
                            <option value="user">Select Status for group</option>
                            <option value="user">user</option>
                            <option value="Admin">Administrator</option>
                            <option value="view">Viewer</option>
			<input type="submit" name="add" value="Add new user" />
                </td></tr></tr>
  
  </table>
    <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
	<tr>
        <tr> <p> Click on the user name on the table below to change the details</p></tr>
	<td><p>Change the group for a user</p></td><td>
		<?PHP echo "<input type='text' name='gusername' maxlength='45' size='30' value='" .$user."' />"; ?>
   	</td>
      	<td>
       		<select id="group1" name="group1">
      		<option value="user">Select Status for group</option>
      		<option value="user">user</option>
      		<option value="Admin">Administrator</option>
                <option value="view">Viewer</option>
      	</td>
        <td>
            	<input type="submit" name="cgroup" value="Update Group for user" />
        </td>      	
    </tr>
    <tr>
    <td>
        <p>Change the email of a user</p>
    <td>
        <?PHP echo "<input type='hidden' name='user' value='".$user."' />"; ?>
        <?PHP echo "<input type='hidden' name='ID' value='".$ID."' />"; ?>
        <?PHP echo "<input type='text' name='cemail' maxlength='45' size='30' value='" .$cemail."' />"; ?>
        
        </td>
                <td>
            	<input type="submit" name="c-email" value="Update email for user" />
        </td>    
   	</td>
        
        
        </td></tr>
		<td>
		<p> Delete a user</p></td><td>
		<?PHP echo "<input type='text' name='deluser' maxlength='40' size='40' value='".$user."' /></td><td>"?>
		<input type="submit" name="del" value="Delete user" /></td><td>
	</tr>

 </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>Username1</td>
    <td>First Name</td>
    <td>Surname</td>
    <td>Group</td>
    <td>email</td>
   
  </tr>

<?php

$result = mysqli_query($connection, "SELECT l.id, l.username,l.first,l.last, l.group, l.email FROM login l"); 

while($query_data = mysqli_fetch_row($result)) {
  $Link="<a href='admin.php?ID=$query_data[0]&user=$query_data[1]&cemail=$query_data[5]'>";  
  echo "<tr>";
  echo "<td>$Link",$query_data[0], "</td>",
       "<td>$Link",$query_data[1], "</td>",
       "<td>$Link",$query_data[2], "</td>",
       "<td>$Link",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>",          
       "<td>",$query_data[5], "</td>";
  echo "</tr>";

}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>
<?php

	/* Update Group. */
	function UpdateGroup($connection, $gusername, $group) {
   		$u = mysqli_real_escape_string($connection, $gusername);
   		$g = mysqli_real_escape_string($connection, $group);
   		
  		//echo($g);
   		$Groupquery = "UPDATE login set login.group ='$g'  where username = '$u';";
		echo "<p>done</p>";
   		if(!mysqli_query($connection, $Groupquery)) echo("<p>Error updating group.</p>");
	}

	/* Insert user */

	function AddUser($connection, $newuser, $newpass,$newemail,$newgroup){
		$u = mysqli_real_escape_string($connection, $newuser);
		$p = mysqli_real_escape_string($connection, $newpass);
		$e = mysqli_real_escape_string($connection, $newemail);
		$g = mysqli_real_escape_string($connection, $newgroup);                
		$VarCodeQuery = "insert into login (login.username, login.password,login.email,login.group) values ('$u' , '$p','$e','$g');";

		if(!mysqli_query($connection, $VarCodeQuery)) echo("<p>Error updating Variance code.</p>");

	}

	function DelUser($connection, $deluser){
	/* delete the selected user. */

 		$u = mysqli_real_escape_string($connection, $deluser);
 		$Delquery =  "DELETE FROM login WHERE username = '$u';";

		if(!mysqli_query($connection, $Delquery)) echo("<p> Could not delete the selected ID.</p>");

	}
	// reset the users password
	function CPass($connection, $resetuser, $resetpass){

		$u = mysqli_real_escape_string($connection, $resetuser);
		$p = mysqli_real_escape_string($connection, $resetpass);
		echo ("resetting the user: ".$u." password to: ".$p);
		$CpassSQL = "UPDATE login set password = '$p' where username = '$u';";
 		if(!mysqli_query($connection, $CpassSQL)) echo("<p> Could not delete the selected ID.</p>");
	//	if(!mysqli_query($connection, $CPassSQL)) echo ("<p> could not update users password.</p>");

	}
        
        function Cemail($connection, $cemail, $ID,$user1){
            
            $e= mysqli_real_escape_string($connection, $cemail);
            $i= mysqli_real_escape_string($connection, $ID);
            $u= mysqli_real_escape_string($connection, $user1);            
		echo ("Changing the email for user: ".$u."  to: ".$e);
		$CpassSQL = "UPDATE login set email = '$e' where id = '$i';";
 		if(!mysqli_query($connection, $CpassSQL)) echo("<p> Could not change the email.</p>");            
            
            
        }
?>
