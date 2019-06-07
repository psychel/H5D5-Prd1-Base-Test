<?php


 
session_start();

include "inc/cdbinfo.inc";
//test browser
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE){
   echo 'Internet explorer';}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE){ //For Supporting IE 11
echo "<script type='text/javascript'>alert('This does not work in Internet Explorer please change to Chrome.');</script>";
$buttonoff='true';}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
 {  echo 'Mozilla Firefox';}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
  { echo 'Google Chrome';}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
  { echo "Opera Mini";}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
 {  echo "Opera";}
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
  { echo "Safari";}
 else
  { echo 'Something else';}


//h5d5-test.cbsx4slcnnpj.us-east-1.rds.amazonaws.com
//$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
//	 if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$mssqldriver = '{SQL Server Native Client 11.0}';

//$dbh = new PDO("sqlsrv:Server=$DB_SERVER;Database=$DB_DATABASE",$DB_USERNAME,$DB_PASSWORD);
$dbh = new PDO('mysql:host=h5d5-test.cbsx4slcnnpj.us-east-1.rds.amazonaws.com;dbname=int', 'Admin', 'D221325r');

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $database = mysqli_select_db($connection, DB_DATABASE);



$message="";
if(!empty($_POST["login"])) {
    $user_name_safe = htmlentities($_POST["user_name"]);
    $password_safe= htmlentities($_POST["password"]);
    $pquery = "select * from login where username=? and password = ?";
    $sql = $dbh->prepare($pquery);
    //$sql->bindParam("ss",$user_name_safe,$password_safe);
    $sql->execute([$user_name_safe,$password_safe]);
    $row = $sql->fetch();
    // $sql->setFetchMode(PDO::FETCH_ASSOC);
    // $row = $sql->fetchAll();
    // $count = $dbh->query("Select count(*) from login")->fetchColumn();

    if($row) {
        $_SESSION["login_user"] = $row['username'];
        $fullname = $row['first'];
        $fullname .=" ".$row['last'];
        $_SESSION["fullname"] = $fullname;
        $_SESSION["group"] = $row['group'];
        $_SESSION["reset"] = $row['reset'];
        $_SESSION["dailylog"] = $row['DailyLog'];
        //Check to see if 'Yes' is weekend working
        $_SESSION["WW"] = $row['WW'];
        //Check to see if 'Yes' in weekend working administration
        $_SESSION["WWadmin"] = $row['WWadmin'];
        $_SESSION["Company"] = $row['Company'];
        $resetcheck = $row['reset'];
        if ($resetcheck == 0){

            header('Location: emailpass.php');
        }
        else{
            $pquery = "update login set logtime=? where username=?";
            $today = date("Y-m-d H:i:s");
            $sql = $dbh->prepare($pquery);
            $sql->execute([$today,$user_name_safe]);
            header('Location: main.php'); // Goto main page
        }
    }
    else {
        $_SESSION['login_user'] = "";
        session_destroy();
        $message = "Invalid Username or Password!";
    }
}
if(!empty($_POST["logout"])) {
    $_SESSION['login_user'] = "";
    session_destroy();
}

if(isset($_POST['reset'])){
    header("Location: pass/");
}

?>

<html>

<div class="background">
<head>
    <h1>Welcome to the HPC integrated toolkit v3.1 (AWS)</h1>
    <title>User Login for integration tool (AWS)</title>

    <h2>                <button class="button1">Where am I now</button><br>

<span>


</span><br>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="./3words-button1.js"></script></h2>


    <style>
        #frmLogin {
            padding: 20px 60px;
            background: #B6E0FF;
            color: #555;
            display: inline-block;
            border-radius: 4px;
        }
        .field-group {
            margin:15px 0px;
        }
        .input-field {
            padding: 8px;width: 200px;
            border: #A3C3E7 1px solid;
            border-radius: 4px;
        }
        .form-submit-button {
            background: #65C370;
            border: 0;
            padding: 8px 20px;
            border-radius: 4px;
            color: #FFF;
            text-transform: uppercase;
        }
        .member-dashboard {
            padding: 40px;
            background: #D2EDD5;
            color: #555;
            border-radius: 4px;
            display: inline-block;
            text-align:center;
        }
        .logout-button {
            color: #09F;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0px;
            cursor: pointer;
        }
        .error-message {
            text-align:center;
            color:#FF0000;
        }
        .demo-content label{
            width:auto;
        }
        .button1 {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #af1110;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .button1:hover {background-color: #3e8e41}

        .button1:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>

</head>
<body>
<div>
    <div style="display:block;margin:0px auto;">
    <?PHP if ($buttonoff !='true'){
         if(empty($_SESSION["user_id"])) { ?>
            <form action="" method="post" id="frmLogin">
                <div class="error-message"><?php if(isset($message)) { echo $message ; } ?></div>
                <div class="field-group">
                    <div><label for="login">Username</label></div>
                    <div><input name="user_name" type="text" class="input-field" placeholder="Badge Number"></div>
                </div>
                <div class="field-group">
                    <div><label for="password">Password</label></div>
                    <div><input name="password" type="password" class="input-field"> </div>
                </div>
            <?PHP
           echo "<div class='field-group'>";
                        echo "<div><input type='submit' name='login' value='Login' class='form-submit-button'></span></div>";
                        echo "</div>";
                        echo "<div class='field-group'>";
                        echo "<div><input type='submit' name='reset' value='Password reminder' class='form-submit-button'></span></div>";
                        echo "</div>";

                    }?>
            </form>
    <?php }else
    {
        echo"You cannot use Internet Explorer to access this tool please change to Chrome.";
    }?>
</body>
</div></html>
</div>

</html>
<?php
include "foot.php";
?>

