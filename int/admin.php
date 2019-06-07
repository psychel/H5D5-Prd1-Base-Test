<?php include_once "inc/cdbinfo.inc"; ?>
<style>
    <?php include_once "admincheck.php";
include_once "style.css";
?>
</style>
<html>
<body>
<h1>Welcome to the Administration page for HPC Integrated Platform</h1>



<br>
<tr>
    <input type="button" onclick="window.location='main.php'"
           class="Redirect" value="Main Page"/>
</tr>

<br>
<tr>
    <input type="button" onclick="window.location='ww/wwadmin.php'"
           class="Redirect" value="WW Admin"/>
</tr>

<br>
<h1> User Management</h1>
<br>
<?php

 
 if(isset($_POST['Add'])){

     ?>
     <script type="text/javascript">
         window.location.href='users/addnewuser.php';
     </script>

     <?PHP
   //          $url = "";
 // header("Location:".$url);
	}
else if(isset($_POST['change']))
{
     ?>
     <script type="text/javascript">
         window.location.href='users/old_search.php';
     </script>

     <?PHP
           //  $url = "users/search.php";
  //header("Location:".$url);
	}
else if(isset($_POST['del'])){
     ?>
     <script type="text/javascript">
         window.location.href='users/delete.php';
     </script>

     <?PHP
            // $url = "users/delete.php";
 // header("Location:".$url);
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
            <td><input type="submit" value="Add New User" name="Add" class="form-submit-button" /></td>
            <td><input type="submit" value="Change User Details" name="change" class="form-submit-button" /></td>
            <td><input type="submit" value="Delete a User" name="del" class="form-submit-button" /></td>
      </tr>
    <tr>
		<tr>

  
  </table>
   

<!-- Clean up.    -->

<?php



?>
<inj>


