<?php include "../inc/cdbinfo.inc";
include "WWcheck.php";
session_start();?>

<!-- link calendar resources -->
<link rel="stylesheet" type="text/css" href="../cal/tcal.css" />
<script type="text/javascript" src="../cal/tcal.js">

</script>

<style>


    <?php  include "../style.css";
    include "../modules/dates.php";

      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

            $database = mysqli_select_db($connection, DB_DATABASE);
// getting variables
     $fullname = $_SESSION['fullname'];
     $Company = $_SESSION['Company'];




    ?>
</style>
<html>
<div class="back">
<h1>Current weekend working information page</h1>

    <input type="button" onclick="window.location='wwFront.php'"
           class="Redirect" value="WW Main Page"/>
    <input type="button" onclick="window.location='wwauth.php'"
           class="Redirect" value="WW Authorised"/>
    <input type="button" onclick="window.location='../main.php'"
           class="Redirect" value="Main Page"/>
<h2> This shows all submitted requests within the timescales and the status of request</h2>


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
            <td>Press reset search</td>
        </tr>

        <td>
            <input type='text' class='tcal' name='datepicker' autocomplete="off" style='height:20px;width:120px;background-color: white;'
                   value="<?PHP if (isset($_POST['datepicker'])) echo $_POST['datepicker']; ?> "/>
        </td>
        <td><input type='text' class='tcal' name='datepicker1' autocomplete="off" style='height:20px;width:120px;background-color: white;'
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

<table class='table2'>
    <tr>
        <td>ID</td>
        <td>Requester</td>
        <td>When Requested</td>
        <td>Contractor</td>
        <td>Required Date</td>
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
        <td>When Authorised</td>
        <td>Rej. Comments</td>

    </tr>

    <?php
    $curr1=$_POST['datepicker'];
    $dateto=$_POST['datepicker1'];
    $date = date("Y-m-d", strtotime($curr1));
    $dateto1 = date("Y-m-d", strtotime($dateto));
    echo "extracting data between ". $curr1 . " and " .$dateto;
    $str="TRUE";
    if(empty($dateto)){
        $filter = "  c.ReqDate >= '" . $date ."'";
    }else{
        $filter = " c.ReqDate >= '" . $date . "' and c.ReqDate <= '" .$dateto1 . "'";
    }
    //company filter (strtolower($query_data[1])==strtolower('Balfours'))
    if(strtolower($Company)!=strtolower("NNB")){
         $filter .= " and c.Contractor like '" . $Company . "'";
    }
    echo $filter;
    $result = mysqli_query($connection, "SELECT 
		c.ID,
		c.Requester,
		date_format(c.RequestedDate, '%d-%m-%y %H:%i'),
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
		c.RejComments
	FROM ww_req as c 
	where 
	$filter
	group by c.ID
	order by c.ReqDate");

    while ($query_data = mysqli_fetch_row($result)) {
        //$total += $query_data[12];
        $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";
        if(strpos($query_data[15],'Rejected')===0)
        {$bckcolour='Red';}
        elseif(strpos($query_data[15],'Not')===0){
            $bckcolour='Red';
        }
        else{$bckcolour='lightGreen';}

        echo "<tr>";
        echo "<td>", $query_data[0], "</td>",
        "<td bgcolor='$bckcolour'>", $query_data[1], "</td>",
        "<td>", $query_data[2], "</a></td>",
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
        "<td bgcolor='$bckcolour'>", $query_data[15], "</td>",
        "<td>", $query_data[16], "</td>",
        "<td>", $query_data[17], "</td>";

        echo "</tr>";

    }


    mysqli_free_result($result);
    mysqli_close($connection);

    }


    ?>
</table>
    </form>
</div>  </html>



    <?php
    include "../foot.php";
    ?>
