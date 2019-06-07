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
    $Name           = $fullname;
    $VarCodeQuery = "update ww_req SET
            Authorised='$Name',
            AuthDate=NOW()
                        
                        Where ID = '$ID2';";
    if(!mysqli_query($connection, $VarCodeQuery)) {
        echo("<p>Error updating data.</p>" );
    }else{
        echo ("<p>The activity $ID2 has been Authorised.</p>");
    }
}elseif (isset($_POST['reject'])){

    $ID2 = htmlentities($_POST['reject']);
    $Check = htmlentities($_POST['RejComments']);
    $Name = $fullname;
    $RejComments = $Check;

    $VarCodeQuery = "update ww_req SET
            Authorised='Rejected by - $Name',
            AuthDate=NOW(),
            RejComments = '$RejComments'
                        Where ID = '$ID2';";
        if(!mysqli_query($connection, $VarCodeQuery)) {
            echo("<p>Error updating data.</p>" );
        }else{
            echo ("<p>The activity $ID2 has been Rejected for this reason $RejComments, by $Name</p>");
        }




}
?>
<html>
<div class="back">
<body>
<h1>Weekend Working Request Page</h1>
<input type="button" onclick="window.location='wwFront.php'"
       class="Redirect" value="WW Main Page"/>
<input type="button" onclick="window.location='wwauth.php'"
       class="Redirect" value="WW Authorised"/>
<input type="button" onclick="window.location='../main.php'"
       class="Redirect" value="Main Page"/>
<h2> Select to Authorise Weekend Working Request</h2>
<?php
session_start();
  /*function to send to sql command*/
 if(isset($_POST['add']))
 {
     $contractor                =       htmlentities($_POST['contractor']);
     $reqdate                   =       htmlentities($_POST['reqdate']);
     $areas                     =       htmlentities($_POST['areas']);
     $task                      =       htmlentities($_POST['task']);
     $super                     =       htmlentities($_POST['super']);
     $daynum                    =       htmlentities($_POST['daynum']);
     $nightnum                  =       htmlentities($_POST['nightnum']);
     $aiders                    =       htmlentities($_POST['aiders']);
     $plant                     =       htmlentities($_POST['plant']);
     $ConDutyMan                =       htmlentities($_POST['ConDutyMan']);
     $ConDutyManPos             =       htmlentities($_POST['ConDutyManPos']);
     $ConDutyManCont            =       htmlentities($_POST['ConDutyManCont']);
     $Requester                 =       htmlentities($_POST['Requester']);
     $RequestedDate             =       htmlentities($_POST['RequestedDate']);
     // SQL script to push the data in
     $contractor1               =       mysqli_real_escape_string($connection, $contractor);
     $reqdate1                  =       mysqli_real_escape_string($connection, $reqdate);
     $areas1                    =       mysqli_real_escape_string($connection, $areas);
     $task1                     =       mysqli_real_escape_string($connection, $task);
     $super1                    =       mysqli_real_escape_string($connection, $super);
     $daynum1                   =       mysqli_real_escape_string($connection, $daynum);
     $nightnum1                 =       mysqli_real_escape_string($connection, $nightnum);
     $aiders1                   =       mysqli_real_escape_string($connection, $aiders);
     $plant1                    =       mysqli_real_escape_string($connection, $plant);
     $ConDutyMan1               =       mysqli_real_escape_string($connection, $ConDutyMan);
     $ConDutyManPos1            =       mysqli_real_escape_string($connection, $ConDutyManPos);
     $ConDutyManCont1           =       mysqli_real_escape_string($connection, $ConDutyManCont);
     $Requester1                =       mysqli_real_escape_string($connection, $Requester);
     $RequestedDate1            =       mysqli_real_escape_string($connection, $RequestedDate);
     $VarCodeQuery = "insert into ww_req (
            Contractor,
            ReqDate,
            Areas,
            Tasks,
            SuperContact,
            DayNum,
            NightNum,
            FirstAiders,
            Plant,
            ContractorDutyMan,
            ContractorDutyManPosition,
            ContractorDutyManTel,
            Requester,
            RequestedDate
            
                ) values (
                '$contractor1',
                STR_TO_DATE('$reqdate1','%d-%m-%Y'),
                '$areas1',
                '$task1',
                '$super1',
                '$daynum1',
                '$nightnum1',
                '$aiders1',
                '$plant1',
                '$ConDutyMan1',
                '$ConDutyManPos1',
                '$ConDutyManCont1',
                '$Requester1',
                '$RequestedDate1'
                        );";

     if(!mysqli_query($connection, $VarCodeQuery)) {
         echo("<p>Error updating data.</p>" );
     }else{
         echo ("<p>The activity $description has been added.</p>");
     }

 }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
    <table class="table2">
        <tr>
            <td>ID</td>
            <td>Contractor</td>
            <td>Requested Date</td>
            <td>Requester</td>
            <td>Date of request</td>
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
            <td>Authorise</td>
            <td>Rejection Comments</td>
            <td>Rejection Button</td>
        </tr>

        <?php
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
	where c.Authorised  like 'Not'
	group by c.ID
	order by c.ReqDate");

        while($query_data = mysqli_fetch_row($result)) {
            //$total += $query_data[12];
            $Link="<a href='ww_detail.php?ID=$query_data[0]'>";
            $VarID = $query_data[0];
                echo  "<tr>";
                echo  "<td>",$query_data[0], "</td>",
                "<td bgcolor='$bckcolour'>",$query_data[1], "</td>",
                "<td>", $query_data[2], "</a></td>",
                "<td>", $query_data[15], "</a></td>",
                "<td>", $query_data[16], "</a></td>",
                "<td>",$query_data[3], "</td>",
                "<td>",$query_data[4], "</td>",
                "<td>",$query_data[5], "</td>",
                "<td>",$query_data[6], "</td>",
                "<td>",$query_data[7], "</td>",
                "<td>",$query_data[8], "</td>",
                "<td>",$query_data[9], "</td>",
                "<td>",$query_data[10], "</td>",
                "<td>",$query_data[11], "</td>",
                "<td>",$query_data[12], "</td>",
                "<td>",$query_data[13], "</td>",
                "<td>",$query_data[14], "</td>",
                "<td>";
                echo "<input type='submit' data-value2='data 2' name='auth' value='" . $query_data[0] ."' style='height:30px;width:50px;'/>","</td>";
                echo "<td><textarea name='RejComments' "  .$readonly." style='height:50px;width:150px;' wrap='soft'></textarea></td>";
                echo "<td><button type='reject' data-value2='data 2' value='" . $query_data[0] ."' name='reject' style='height:30px;width:50px;'>" . $query_data[0] ."</button>","</td>";

                echo  "</tr>";

        }
        ?>

    </table>


    <!-- Clean up. -->
    <?php

    mysqli_free_result($result);
    mysqli_close($connection);

    ?>

</body>
</div>
</html>
<?php
include "../foot.php";
?>

