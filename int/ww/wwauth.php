<?php include "../inc/cdbinfo.inc";
include "compcheck.php";?>
<!-- link calendar resources -->
<link rel="stylesheet" type="text/css" href="../cal/tcal.css" />
<script type="text/javascript" src="../cal/tcal.js">
</script>
<script language=Javascript>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if  (charCode >31  &&(charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<style>
    <?php  include "../style.css";
    include "../modules/dates.php";
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
            $database = mysqli_select_db($connection, DB_DATABASE);
// getting variables
     $fullname = $_SESSION['fullname'];
    ?>
</style>
<?PHP
if(isset($_POST['auth'])) {
    print_r($_POST);
    $ID2 = htmlentities($_POST['auth']);
    $Name           = '';
    $VarCodeQuery = "update ww_req SET
            Authorised='Not',
            AuthDate=now()                      
                        Where ID = '$ID2';";
    if(!mysqli_query($connection, $VarCodeQuery)) {
        echo("<p>Error updating data.</p>" );
    }else{
        echo ("<p>The activity $ID2 has been Authorised.</p>");
    }

}
if(isset($_POST['reset'])){
    unset($_POST['datepicker']);
    unset($_POST['datepicker1']);
}
?>
<html>
<div class="back">
<body>
<h1>View of authorised requests page</h1>

<input type="button" onclick="window.location='wwFront.php'"
       class="Redirect" value="WW Main Page"/>
<input type="button" onclick="window.location='wwauth.php'"
       class="Redirect" value="WW Authorised"/>
<input type="button" onclick="window.location='../main.php'"
       class="Redirect" value="Main Page"/>
<input type="button" onclick="window.location='ww2auth.php'"
       class="Redirect" value="Pending"/>
<h2> This shows all the Authorised weekend request forms in detail</h2>


<?php
session_start();
?>
</table>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <table  class="table3">
        <tr>
            <br>
            <td> Date From</td>
            <td> Date To</td>
            <td>Just press search for all data post today</td>
            <td>Press reset to remove dates</td>
        </tr>
        <td>
            <input type='text' class='tcal' name='datepicker' autocomplete="off" style='height:20px;width:120px;'
                   value="<?PHP if (isset($_POST['datepicker'])) echo $_POST['datepicker']; ?> "/>
        </td>
        <td><input type='text' class='tcal' name='datepicker1' autocomplete="off" style='height:20px;width:120px;'
                   value="<?PHP if (isset($_POST['datepicker1']))echo $_POST['datepicker1'];?>"/>
        </td>
        <td>
            <input type='submit' name='search' value='Search' style='height:30px;width:100px;'/>
        </td>
        <td>
            <input type='submit' name='reset' value='Reset' style='height:30px;width:100px;'/>
        </td>
        </tr>
    </table>
</form>
<!-- Input form -->
<?PHP
if(isset($_POST['search'])){
    print_r($_POST);
?>
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
<table class='table2'>
    <tr>
        <td>ID</td>
        <td>Contractor</td>
        <td>Requested Date</td>
        <td>Requester</td>
        <td>Time requested</td>
        <td>Areas of work</td>
        <td>Tasks</td>
        <td>Supervisor Details</td>
        <td>Day Workforce</td>
        <td>Night Workforce</td>
        <td>First Aiders</td>
        <td>Plant in use</td>
        <td>Cont. Duty Manager</td>
        <td>Position</td>
        <td>Contact Details</td>
        <td>Authorised By NNB</td>
        <td>Date time</td>
        <td bgcolor="#ff4500"> UNAUTHORISE</td>
    </tr>

    <?php
    $curr1=$_POST['datepicker'];
    $dateto=$_POST['datepicker1'];
    $date = date("Y-m-d", strtotime($curr1));
    $dateto1 = date("Y-m-d", strtotime($dateto));
    echo "extracting data between ". $curr1 . " and " .$dateto;
    $str="TRUE";
    if(empty($dateto)){
        $filter = " and c.ReqDate >= '" . $date ."'";
    }else{
        $filter = "and c.ReqDate >= '" . $date . "' and c.ReqDate <= '" .$dateto1 . "'";
    }
    echo $filter;
    $result = mysqli_query($connection, "SELECT 
		c.ID,
		c.Contractor,
        date_format(c.ReqDate, '%d-%m-%y'),
        c.Areas,
        c.Tasks,
		c.SuperContact,
		c.DayNum,
        c.NightNum,
        c.FirstAiders,
		c.Plant,
        c.ContractorDutyMan,       
        c.ContractorDutyManPosition,
        c.ContractorDutyManTel,
        c.Authorised,
		date_format(c.AuthDate , '%d-%m-%y %H:%i'),
		c.Requester,
		date_format(c.RequestedDate , '%d-%m-%y %H:%i')
	FROM ww_req as c 
	where c.Authorised not like 'Not'
	$filter
	group by c.ID
	order by c.ReqDate");

    while ($query_data = mysqli_fetch_row($result)) {
        //$total += $query_data[12];
        $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";


        echo "<tr>";
        echo "<td>", $query_data[0], "</td>",
        "<td bgcolor='$bckcolour'>", $query_data[1], "</td>",
        "<td>", $query_data[2], "</a></td>",
        "<td>", $query_data[15], "</a></td>",
        "<td>", $query_data[16], "</a></td>",
        "<td>", $query_data[3], "</td>",
        "<td>", $query_data[4], "</td>",
        "<td>", $query_data[5], "</td>",
        "<td>", $query_data[6], "</td>",
        "<td>", $query_data[7], "</td>",
        "<td>", $query_data[8], "</td>",
        "<td>", $query_data[9], "</td>",
        "<td>", $query_data[10], "</td>",
        "<td>", $query_data[11], "</td>",
        "<td>", $query_data[12], "</td>",
        "<td>", $query_data[13], "</td>",
        "<td>", $query_data[14], "</td>",
        "<td>";
        echo "<input type='submit' data-value2='data 2' name='auth' value='" . $query_data[0] . "' style='height:30px;width:100px;'/>", "</td>";
        echo "</tr>";
    }
    mysqli_free_result($result);
    mysqli_close($connection);
    }
    ?>
</form>
</table>
</div>
</body>
</html>
<?php
include "../foot.php";
?>


