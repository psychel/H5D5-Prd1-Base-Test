<?php include "../inc/cdbinfo.inc"; ?>
<?php include "../admincheck.php";

?>
<style>
    <?php
include "../style.css";
?>
</style>
<?PHP
    /* Connect to MySQL and select the database. */
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
    $database = mysqli_select_db($connection, DB_DATABASE);

//get the post data from search page
$ID                 = $_GET['ID'];
$username           = $_GET['username'];
$first              = $_GET['first'];
$last               = $_GET['last'];
$group              = $_GET['group'];
$email              = $_GET['email'];
$company            = $_GET['company'];
$dailylog           = $_GET['dailylog'];
$ww                 = $_GET['ww'];
$wwa                = $_GET['wwa'];
$logtime            = $_get['log'];

if(isset($_POST['update']))
{
    $username           = $_POST['username'];
    $first              = $_POST['first'];
    $last               = $_POST['last'];
    $group              = $_POST['group'];
    $email              = $_POST['email'];
    $company            = $_POST['company'];
    $dailylog           = $_POST['dailylog'];
    $ww                 = $_POST['ww'];
    $wwa                = $_POST['wwa'];

    $ID1        = mysqli_real_escape_string($connection, $ID);
    $username1  = mysqli_real_escape_string($connection, $username);
    $first1     = mysqli_real_escape_string($connection, $first);
    $last1      = mysqli_real_escape_string($connection, $last);
    $group1     = mysqli_real_escape_string($connection, $group);
    $email1     = mysqli_real_escape_string($connection, $email);
    $company1   = mysqli_real_escape_string($connection, $company);
    $dailylog1  = mysqli_real_escape_string($connection, $dailylog);
    $ww1        = mysqli_real_escape_string($connection, $ww);
    $wwa1       = mysqli_real_escape_string($connection, $wwa);


    //echo($g);
    $updatequery = "UPDATE login set 
                      login.username ='$username1'
                      ,login.first = '$first1'
                      ,login.last = '$last1' 
                      ,login.group = '$group1'
                      ,login.email = '$email1' 
                      ,login.Company ='$company1'
                      ,login.DailyLog = '$dailylog1'
                      ,login.WW = '$ww1'
                      ,login.WWadmin = '$wwa1'
                      where id = '$ID';";

    echo "<p>User Changed</p>" ;
    if(!mysqli_query($connection, $updatequery)) echo("<p>Error updating group.</p>");
}
?>
<html>
<body>
<h1>Welcome to the User Administration page</h1>

<br>


<form action="<?PHP  $_SERVER['SCRIPT_NAME'] ?>" method="POST">
    <table border="0">
        <tr>
            <td>        <input type="button" onclick="window.location='../main.php'"
                               class="Redirect" value="Main"/></td>
            <td>        <input type="button" onclick="window.location='../admin.php'"
                               class="Redirect" value="Main Admin Page"/></td>
            <td>        <input type="button" onclick="window.location='old_search.php'"
                               class="Redirect" value="User search"/></td>
        </tr>
        <tr>
        <tr>


    </table>
<h1> User management</h1>

        <tr>
        <td><p>ID - <?PHP echo $ID;?> </p></td>
        </tr><tr><td><p>Username - </td>
            <td><input type='text1' name='username' maxlength='45' size='40' value='<?PHP echo $username;?>' /></p></td>
        </tr><tr><td><p>First Name - </td>
            <td><input type='text1' name='first' maxlength='45' size='40' value='<?PHP echo $first;?>' /></p></td>
        </tr><tr><td><p>Last Name - </td>
            <td><input type='text1' name='last' maxlength='45' size='40' value='<?PHP echo $last;?>' /></p></td>
        </tr><tr><td><p>Group Access Rights - </td>
        <?PHP
        $res1 = mysqli_query($connection,
            "select distinct (int.login.`group`) from login" );
        if(mysqli_num_rows($res1)){
            $select= '<select name="group" style="position: absolute; left: 250px;" onchange=\"reload(this.form)\">';
            $select.= " <option value=''>Select</option>";
            while($rs=mysqli_fetch_array($res1)){
                if($rs['group']!=''){
                    $select .= '<option value="' . $rs['group'] . '" ';
                    if ($group == $rs['group']) {
                        $select .= ' selected = "selected"';
                    }
                    $select .= '>' . $rs['group'] . '</option>';
                }
            }
        }
        $select.='</select>';
        echo $select;

        ?></td>

        </tr><tr><td><p>Email - </td>
            <td><input type='text1' name='email' maxlength='45' size='40' value='<?PHP echo $email;?>' /></p></td>
        </tr><tr><td><p>Company</td><td>
            <?PHP
            $res = mysqli_query($connection,
                "select distinct (ContractorName)
                                    from contractors 
                                  " );
            if(mysqli_num_rows($res)){
                $select= '<select name="company" style="position: absolute; left: 250px;" onchange=\"reload(this.form)\">';
                $select.= " <option value=''>Select</option>";
                while($rs=mysqli_fetch_array($res)){
                    if($rs['ContractorName']!=''){
                        $select .= '<option value="' . $rs['ContractorName'] . '" ';
                        if ($company == $rs['ContractorName']) {
                            $select .= ' selected = "selected"';
                        }
                        $select .= '>' . $rs['ContractorName'] . '</option>';
                    }
                }
            }
            $select.='</select>';
            echo $select;

            ?></td>
        </tr><tr><td><p>Daily Log - </td>
        <td>
            <?php if($readonly != 'readonly'){echo ("<select id='dailylog' name='dailylog' style=\"position: absolute; left: 250px;\">");}?>
            <option value="">--Status</option>
            <option <?php if($dailylog == 'Yes') {echo ("selected");}?> value="Yes">Yes</option>
            <option <?php if($dailylog == 'No') {echo ("selected");}?> value="No">No</option>
        </td></select></td></tr>
        </tr><tr><td><p>Weekend Working - </td>
            <td>
            <?php if($readonly != 'readonly'){echo ("<select id='ww' name='ww' style=\"position: absolute; left: 250px;\">");}?>
                <option value="">--Status</option>
                <option <?php if($ww == 'Yes') {echo ("selected");}?> value="Yes">Yes</option>
                <option <?php if($ww == 'No') {echo ("selected");}?> value="No">No</option>
            </td></select></td></tr>
        <tr><td><p>Weekend Working Admin - </td>
            <td>
                <?php if($readonly != 'readonly'){echo ("<select id='wwa' name='wwa' style=\"position: absolute; left: 250px;\" >");}?>
                <option value="">--Status</option>
                <option <?php if($wwa == 'Yes') {echo ("selected");}?> value="Yes">Yes</option>
                <option <?php if($wwa == 'No') {echo ("selected");}?> value="No">No</option>
                </select>
            </td></tr><p></p><tr>
    <td><input type="submit" value="Update" name="update" class="form-submit-button" style="width:100px"/></td></tr>
</form>