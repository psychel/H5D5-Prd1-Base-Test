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

    <h1>Weekend working view upcoming page</h1>

    <input type="button" onclick="window.location='wwFront.php'"
           class="Redirect" value="WW Main Page"/>
    <input type="button" onclick="window.location='wwauth.php'"
           class="Redirect" value="WW Authorised"/>
    <input type="button" onclick="window.location='../main.php'"
           class="Redirect" value="Main Page"/>
    <input type="button" onclick="window.location='ww2auth.php'"
           class="Redirect" value="Pending"/>
    <h1> This shows all the Requests for the upcoming weekend and their status</h1>


    <?php
    session_start();

    ?>



    </table>


    <!-- Input form -->
    <?PHP

    ?>

    <table class='table2'>
        <h2>Not yet Authorised</h2>
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

        </tr>

        <?php

        $str="TRUE";
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
	where c.Authorised like '%Not%'
	and (c.ReqDate BETWEEN NOW() AND (NOW() + INTERVAL 7 DAY) )
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
        "<td>", $query_data[14], "</td>";
        echo "</tr>";
        }?>

        <table class='table2'>
            <h2>Authorised</h2>
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

            </tr>

            <?php

            $str = "TRUE";
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
	where c.Authorised not like '%Not%' and c.Authorised not like '%Rej%'
	and (c.ReqDate BETWEEN NOW() AND (NOW() + INTERVAL 7 DAY) )
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
                "<td>", $query_data[14], "</td>";

                echo "</tr>";


            }?>
        <table class='table2'>
            <h2>Rejected</h2>
            <tr>
                <td>ID</td>
                <td>Rejection Comments</td>
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

            </tr>

            <?php

            $str = "TRUE";
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
		date_format(c.RequestedDate , '%d-%m-%y %H:%i'),
		c.RejComments
	FROM ww_req as c 
	where c.Authorised like '%Rej%' 
	and (c.ReqDate BETWEEN NOW() AND (NOW() + INTERVAL 7 DAY) )
	group by c.ID
	order by c.ReqDate");

            while ($query_data = mysqli_fetch_row($result)) {
                //$total += $query_data[12];
                $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";
                echo "<tr>";
                echo "<td>", $query_data[0], "</td>",
                "<td>", $query_data[17], "</a></td>",
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
                "<td>", $query_data[14], "</td>";

                echo "</tr>";


            }
            mysqli_free_result($result);
            mysqli_close($connection);




        ?>

        </form>
    </table>
</div>
</body>

</html>

<?php
include "../foot.php";
?>


