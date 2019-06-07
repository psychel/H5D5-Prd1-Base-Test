<?php include "../inc/cdbinfo.inc"; ?>
<?php include "../admincheck.php";
include "../modules/col.php"
?>
<style>
    <?php
include "../style.css";
?>
</style>
<html>
<body>
<h1>Welcome to the User Administration page</h1>

<br>

<a href="../main.php">Click here to goto the Main Page</a>
<br>
<a href="../admin.php">Click here to go back to admin page</a>

<br>
<a href="../add.php">Click here to add a single line to the database</a>
<br>
<h1> User management</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the Monday table. */
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


else if (isset($_POST['c-email'])){
        $user1 =$_POST['user']; 
	$cemail = htmlentities($_POST['cemail']);
        $ID = htmlentities($_POST['ID']);
        Cemail($connection, $cemail, $ID,$user1);	
}
else if (isset($_POST['DailyLog'])){
    $user1 =$_POST['user'];
    $DailyLog = htmlentities($_POST['DailyLog1']);
    $ID = htmlentities($_POST['ID']);
    DailyLog($connection, $DailyLog, $ID,$user1);
}
else if (isset($_POST['WW'])){
    $user1 =$_POST['user'];
    $WW = htmlentities($_POST['WW1']);
    $ID = htmlentities($_POST['ID']);
    WW($connection, $WW, $ID,$user1);
}


$dailylog = $_GET['dailylog'];
$user=$_GET['user'];
$cemail = $_GET['cemail'];
$ID = $_GET['ID'];
$WW = $_GET['WW'];
$WWadmin = $_GET['WWadmin'];

?>

<!-- Input form -->

    <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
	<tr>
        <tr>  Click on the user name on the table below to change the details</tr>
	<td>Change the group for a user</td><td>
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
          <p>
              Access to Daily Log
          </p>
      </td>
      <td>
          <select id="DailyLog1" name="DailyLog1">
              <option value="No">Select Status for Access to Daily log</option>
              <option value="No">No</option>
              <option value="Yes">Yes</option>
      </td>
      <td>
          <input type="submit" name="DailyLog" value="Update Access to Daily Log" />
      </td>
      <td>
          <p>
              Access to Weekend Working-R/O
          </p>
      </td>
      <td>
          <select id="WW1" name="WW1">
              <option value="No">Select Status for Access to Daily log</option>
              <option value="No">No</option>
              <option value="Yes">Yes</option>
      </td>
      <td>
          <input type="submit" name="WW" value="Update Access to Weekend Working" />
      </td>
 </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2" id="myTable1" class="table1">
  <tr>
    <td onclick="sortTable1(0)">ID</td>
    <td onclick="sortTable1(1)">Username1</td>
    <td onclick="sortTable1(2)">First Name</td>
    <td onclick="sortTable1(3)">Surname</td>

    <td onclick="sortTable1(4)">Group</td>
    <td onclick="sortTable1(5)">email</td>
      <td onclick="sortTable1(6)">Company</td>
      <td onclick="sortTable1(7)">Daily log</td>
      <td onclick="sortTable1(8)">Weekend Working</td>
      <td onclick="sortTable1(9)">Weekend Working Admin</td>

  </tr>

<?php

$result = mysqli_query($connection, "SELECT l.id, l.username,l.first,l.last, l.group, l.email, l.Company,l.DailyLog,l.WW,l.WWadmin FROM login l order by l.Company");

while($query_data = mysqli_fetch_row($result)) {
  $Link="<a href='change.php?ID=$query_data[0]&user=$query_data[1]&cemail=$query_data[5]&Company=$query_data[6]&WW=$query_data[7]&WWadmin=$query_data[8]'>";
//  echo "<table id='Mytable2'>";
  echo "<tr>";
  echo "<td>$Link",$query_data[0], "</td>",
       "<td>$Link",$query_data[1], "</td>",
       "<td>$Link",$query_data[2], "</td>",
       "<td>$Link",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>",
        "<td>",$query_data[5], "</td>",
        "<td>",$query_data[6], "</td>",
        "<td>",$query_data[7], "</td>",
        "<td>",$query_data[8], "</td>",
       "<td>",$query_data[9], "</td>";
  echo "</tr>";
  //echo "</table>";

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
//Change access to daily logs

function DailyLog($connection, $DailyLog, $ID, $gusername) {
    $u = mysqli_real_escape_string($connection, $gusername);
    $g = mysqli_real_escape_string($connection, $DailyLog);

    //echo($g);
    $Groupquery = "UPDATE login set login.DailyLog ='$g'  where username = '$u';";
    echo "<p>done</p>";
    if(!mysqli_query($connection, $Groupquery)) echo("<p>Error updating group.</p>");
}
//Weekend Working

function WW($connection, $WW, $ID, $gusername) {
    $u = mysqli_real_escape_string($connection, $gusername);
    $g = mysqli_real_escape_string($connection, $WW);

    //echo($g);
    $Groupquery = "UPDATE login set login.WW ='$g'  where username = '$u';";
    echo "<p>done</p>";
    if(!mysqli_query($connection, $Groupquery)) echo("<p>Error updating group.</p>");
}


	function DelUser($connection, $deluser){
	/* delete the selected user. */

 		$u = mysqli_real_escape_string($connection, $deluser);
 		$Delquery =  "DELETE FROM login WHERE username = '$u';";

		if(!mysqli_query($connection, $Delquery)) echo("<p> Could not add to weekend working.</p>");

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
