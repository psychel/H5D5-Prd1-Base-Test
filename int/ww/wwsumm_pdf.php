<?php include "../inc/cdbinfo.inc";
session_start();?>

<!-- link calendar resources -->
<link rel="stylesheet" type="text/css" href="../cal/tcal.css" />
<script type="text/javascript" src="../cal/tcal.js">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="../pdf/tableExport.js"></script>
<script type="text/javascript" src="../pdf/jquery.base64.js"></script>
    <script type="text/javascript" src="../pdf/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../pdf/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../pdf/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="../pdf/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../pdf/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../pdf/jspdf/libs/base64.js"></script>
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

<html>
<body>
<h1>Weekend Working Notification Summary</h1>

<a href="wwFront.php">Click here to goto the Weekend working main page</a><p></p>
<a href="../admin.php">Click here to go back to the Admin page</a><p></p>
<a href="wwauth.php">Click here to goto authorised requests</a><p></p>






<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
    <table class="table5">
        <td>Emergency number 333  </td>
        <td>Employee info line: 0800 3160122  </td>
        <td>Please see form below for complete details  </td>

    </table>

    <div class="container">
        <div class="row">
            <div class="btn-group pull-right" style=" padding: 10px;">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="glyphicon glyphicon-th-list"></span> Dropdown

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false'});"> <img src="../pdf/images/json.jpg" width="24px"> JSON</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="../pdf/images/json.jpg" width="24px">JSON (ignoreColumn)</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'true'});"> <img src="../pdf/images/json.jpg" width="24px"> JSON (with Escape)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'xml',escape:'false'});"> <img src="../pdf/images/xml.png" width="24px"> XML</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'sql'});"> <img src="../pdf/images/sql.png" width="24px"> SQL</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'csv',escape:'false'});"> <img src="../pdf/images/csv.png" width="24px"> CSV</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'txt',escape:'false'});"> <img src="../pdf/images/txt.png" width="24px"> TXT</a></li>
                        <li class="divider"></li>

                        <li><a href="#" onclick="$('#employees').tableExport({type:'excel',escape:'false'});"> <img src="../pdf/images/xls.png" width="24px"> XLS</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'doc',escape:'false'});"> <img src="../pdf/images/word.png" width="24px"> Word</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'powerpoint',escape:'false'});"> <img src="../pdf/images/ppt.png" width="24px"> PowerPoint</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'png',escape:'false'});"> <img src="../pdf/images/png.png" width="24px"> PNG</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src="../pdf/images/pdf.png" width="24px"> PDF</a></li>

                    </ul>
                </div>
            </div>
        </div>
</form>
<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
    <table>


        <?PHP
        $res = mysqli_query($connection,
            "select distinct (ReqDate) from ww_sum where dayname(ReqDate) like 'Saturday' order by ReqDate DESC" );

        if(mysqli_num_rows($res)){
            $select= '<select name="ReqDate" onchange="reload(this.form)">';
            $select.= " <option value=''>--All</option>";
            while($rs=mysqli_fetch_array($res)){
                $DayName = $rs['ReqDate'];
                $DayName1 = date("D d-m-Y",strtotime($DayName));
                if($rs['ReqDate']!=''){
                    $select .= '<option value="' . $rs['ReqDate'] . '" ';
                    if ($_POST['ReqDate'] == $rs['ReqDate']) {
                        $select .= ' selected = "selected"';
                    }
                    $select .= '>' . $DayName1 . '</option>';
                }
            }
        }
        $select.='</select>';
        echo $select;
        ?>
        <input type="submit" name="Data" value="Select Data" style='height:50px;width:150px;' />
    </table>
<?PHP
    if(isset($_POST['Data']))
{
//Data from the summary database

//Saturday data
$ReqDate1 = $_POST['ReqDate'];
$query = $connection->query("SELECT 
		c.ID as ID,
        c.ReqDate as ReqDate,
        c.ConDutyMan as ConDutyMan,
        c.ConDutyManTel as ConDutyManTel,
        c.ConDutyManEmail as ConDutyManEmail,
        c.SODutyMan as SODutyMan,
        k.Value as SODutyManTel,
        c.SODutyManEmail as SODutyManEmail,
        c.HSDutyMan as HSDutyMan,
        c.HSDutyManTel as HSDutyManTel,
        c.HSDutyManEmail as HSDutyManEmail,
        c.ENVDutyMan as ENVDutyMan,
        c.ENVDutyManTel as ENVDutyManTel,
        c.ENVDutyManEmail as ENVDutyManEmail,
        c.EmerController as EmerController,
        c.EmerControllerTel as EmerControllerTel,
        h.Value as HinkleyHealthTel,
        c.SecDutyMan as SecDutyMan,
        c.SecDutyManTel as SecDutyManTel 
	FROM ww_sum  c 
	left join ww_static  h
	on c.HinkleyHealthTel = h.ID 
	left join ww_static  k
	on
	c.SODutyManTel=k.ID
	where c.Reqdate  like '$ReqDate1'
");


while ($fetch = $query->fetch_array()) {
    ?>
    <?php


    //$total += $query_data[12];
    $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";

// header information
    $date = $fetch['ReqDate'];
    $date1 = date("d-m-Y", strtotime($date));
    $day = date("l", strtotime($date));
    echo "<h2>The weekend working request for: " . $day . " - " . $date1 . "</h2>";
    echo "<table id='employees' class='table1'><tr>"
    , "<td>ID</td>"
    , "<td>Required Date</td>"
    , "<td>Construction Duty Manager</td>"
    , "<td>Construction Duty Tel:</td>"
    , "<td>Construction Duty Email:</td></tr>";

    echo "<tr><td><input  style='height:20px;width:50px;' value='", $fetch['ID'], "'/></td>"
    , "<td><input  style=' height:20px;width:150px;' value='", $date1, "'/></td>"
    , "<td><input  style=' height:20px;width:250px;' value='", $fetch['ConDutyMan'], "'/></td>"
    , "<td><input style='height:20px;width:150px;' value='", $fetch['ConDutyManTel'], "'/></td>"
    , "<td><input  style='height:20px;width:250px;' value='", $fetch['ConDutyManEmail'], "'/></td>";
    echo "</tr></table>";
    echo "<table class='table1'><tr>"
    , "<td>Site Ops Manager:</td>"
    , "<td>Site Ops Manager Tel:</td>"
    , "<td>Site Ops Manager Email:</td></tr>";


    echo "<tr><td><input  style='height:20px;width:250px;' value='", $fetch['SODutyMan'], "'/></td>"
    , "<td><input  style='height:20px;width:250px;' value='", $fetch['SODutyManTel'], "'/></td>"
    , "<td><input style='height:20px;width:250px;' value='", $fetch['SODutyManEmail'], "'/></td>";
    echo "</tr></table>";
    echo "<table class='table1'><tr>"
    , "<td>Health and Safety Manager:</td>"
    , "<td>Health and Safety Tel:</td>"
    , "<td>Health and Safety Email:</td></tr>";

    echo "<td><input  style='height:20px;width:250px;' value='", $fetch['HSDutyMan'], "'/></td>"
    , "<td><input  style='height:20px;width:250px;' value='", $fetch['HSDutyManTel'], "'/></td>"
    , "<td><input style='height:20px;width:250px;' value='", $fetch['HSDutyManEmail'], "'/></td>";
    echo "</tr></table>";
    echo "<table class='table1'><tr>"
    , "<td>Env Manager:</td>"
    , "<td>Env Manager Tel:</td>"
    , "<td>Env Manager Email:</td></tr>";

    echo "<td><input  style='height:20px;width:250px;' value='", $fetch['ENVDutyMan'], "'/></td>"
    , "<td><input  style='height:20px;width:250px;' value='", $fetch['ENVDutyManTel'], "'/></td>"
    , "<td><input style='height:20px;width:250px;' value='", $fetch['ENVDutyManEmail'], "'/></td>";
    echo "</tr></table>";
    echo "<table class='table1'><tr>"
    , "<td>Emerg Controller:</td>"
    , "<td>Emerg Controller Tel:</td>"
    , "<td>Hinkley Health Tel:</td></tr>";

    echo "<td><input  style='height:20px;width:250px;' value='", $fetch['EmerController'], "'/></td>"
    , "<td><input  style='height:20px;width:250px;' value='", $fetch['EmerControllerTel'], "'/></td>"
    , "<td><input style='height:20px;width:250px;' value='", $fetch['HinkleyHealthTel'], "'/></td>";
    echo "</tr></table>";
    echo "<table class='table1'><tr>"
    , "<td>Security Duty Manager:</td>"
    , "<td>Security Duty Manager Tel:</td></tr>";
    echo "<td> <input  style='height:20px;width:250px;' value='", $fetch['SecDutyMan'], "'/></td>"
    , "<td> <input  style='height:20px;width:250px;' value='", $fetch['SecDutyManTel'], "'/></td>";
    echo "</tr></table>";
}

?>


    <table class="table2">
        <h2> Detailed information of the date selected</h2>
        <tr>
            <td>ID</td>
            <td>Contractor</td>
            <td>Requested Date</td>
            <td>Req By:</td>
            <td>Time of req.</td>
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
        $ReqDate1 = $_POST['ReqDate'];
        echo $ReqDate1;
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
	where c.Reqdate  like '$ReqDate1' and c.Authorised <>'Not'
	group by c.ID
	order by c.ReqDate");


        while ($query_data = mysqli_fetch_row($result)) {
        //$total += $query_data[12];
            $DayNum +=$query_data['6'];
            $NightNum +=$query_data['7'];
        $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";
        if($query_data[13]=='Not'){$bckcolour='Red';}else{$bckcolour='';}

        echo "<tr>";
        echo "<td>", $query_data[0], "</td>",
        "<td bgcolor='$bckcolour'>", $query_data[1], "</td>",
        "<td>", $query_data[2], "</a></td>",
        "<td>", $query_data[15], "</td>",
        "<td>", $query_data[16], "</td>",
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
        "<td bgcolor='$bckcolour'>", $query_data[13], "</td>",
        "<td>", $query_data[14], "</td>";

        echo "</tr>";
            }

    echo"</table><br><br>";

        echo "<tr><td bgcolor='black'>
            <td bgcolor='black'>
            <td bgcolor='black'></td></td></td>
            <td bgcolor='#eee8aa'>Day Totals : </td>
            <td bgcolor='#eee8aa'>". $DayNum . "</td>
            <td bgcolor='#eee8aa'>Night Numbers :</td>
            <td bgcolor='#eee8aa'>" .$NightNum . "</td></tr><br><br>";
//Sunday --------------------------------------------------------------------------------------------------


        $ReqDate = $_POST['ReqDate'];
        $t = strtotime("$ReqDate +1 day");
        $ReqDate1 = date("Y-m-d", $t);
        $query = $connection->query("SELECT 
		c.ID as ID,
        c.ReqDate as ReqDate,
        c.ConDutyMan as ConDutyMan,
        c.ConDutyManTel as ConDutyManTel,
        c.ConDutyManEmail as ConDutyManEmail,
        c.SODutyMan as SODutyMan,
        k.Value as SODutyManTel,
        c.SODutyManEmail as SODutyManEmail,
        c.HSDutyMan as HSDutyMan,
        c.HSDutyManTel as HSDutyManTel,
        c.HSDutyManEmail as HSDutyManEmail,
        c.ENVDutyMan as ENVDutyMan,
        c.ENVDutyManTel as ENVDutyManTel,
        c.ENVDutyManEmail as ENVDutyManEmail,
        c.EmerController as EmerController,
        c.EmerControllerTel as EmerControllerTel,
        h.Value as HinkleyHealthTel,
        c.SecDutyMan as SecDutyMan,
        c.SecDutyManTel as SecDutyManTel 
	FROM ww_sum  c 
	left join ww_static  h
	on c.HinkleyHealthTel = h.ID 
	left join ww_static  k
	on
	c.SODutyManTel=k.ID
	where c.Reqdate  like '$ReqDate1'
");


        while ($fetch = $query->fetch_array()) {
            ?>
            <?php


            //$total += $query_data[12];
            $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";

// header information
            $date = $fetch['ReqDate'];
            $t = strtotime("$date");
            $date1 = date("d-m-Y", $t);
            $day = date("l", $t);
            echo "<br>-----------------------------------------------------------------------------------------------------------------------------<br>";
            echo "<br><br><p style='page-break-before: always'><h2>The weekend working request for (day2): " . $day . " - " . $date1 . "</h2>";
            echo "<table class='table1'><tr>"
            , "<td>ID</td>"
            , "<td>Required Date</td>"
            , "<td>Construction Duty Manager</td>"
            , "<td>Construction Duty Tel:</td>"
            , "<td>Construction Duty Email:</td></tr>";

            echo "<tr><td><input  style='height:20px;width:50px;' value='", $fetch['ID'], "'/></td>"
            , "<td><input  style=' height:20px;width:150px;' value='", $date1, "'/></td>"
            , "<td><input  style=' height:20px;width:250px;' value='", $fetch['ConDutyMan'], "'/></td>"
            , "<td><input style='height:20px;width:150px;' value='", $fetch['ConDutyManTel'], "'/></td>"
            , "<td><input  style='height:20px;width:250px;' value='", $fetch['ConDutyManEmail'], "'/></td>";
            echo "</tr></table>";
            echo "<table class='table1'><tr>"
            , "<td>Site Ops Manager:</td>"
            , "<td>Site Ops Manager Tel:</td>"
            , "<td>Site Ops Manager Email:</td></tr>";


            echo "<tr><td><input  style='height:20px;width:250px;' value='", $fetch['SODutyMan'], "'/></td>"
            , "<td><input  style='height:20px;width:250px;' value='", $fetch['SODutyManTel'], "'/></td>"
            , "<td><input style='height:20px;width:250px;' value='", $fetch['SODutyManEmail'], "'/></td>";
            echo "</tr></table>";
            echo "<table class='table1'><tr>"
            , "<td>Health and Safety Manager:</td>"
            , "<td>Health and Safety Tel:</td>"
            , "<td>Health and Safety Email:</td></tr>";

            echo "<td><input  style='height:20px;width:250px;' value='", $fetch['HSDutyMan'], "'/></td>"
            , "<td><input  style='height:20px;width:250px;' value='", $fetch['HSDutyManTel'], "'/></td>"
            , "<td><input style='height:20px;width:250px;' value='", $fetch['HSDutyManEmail'], "'/></td>";
            echo "</tr></table>";
            echo "<table class='table1'><tr>"
            , "<td>Env Manager:</td>"
            , "<td>Env Manager Tel:</td>"
            , "<td>Env Manager Email:</td></tr>";

            echo "<td><input  style='height:20px;width:250px;' value='", $fetch['ENVDutyMan'], "'/></td>"
            , "<td><input  style='height:20px;width:250px;' value='", $fetch['ENVDutyManTel'], "'/></td>"
            , "<td><input style='height:20px;width:250px;' value='", $fetch['ENVDutyManEmail'], "'/></td>";
            echo "</tr></table>";
            echo "<table class='table1'><tr>"
            , "<td>Emerg Controller:</td>"
            , "<td>Emerg Controller Tel:</td>"
            , "<td>Hinkley Health Tel:</td></tr>";

            echo "<td><input  style='height:20px;width:250px;' value='", $fetch['EmerController'], "'/></td>"
            , "<td><input  style='height:20px;width:250px;' value='", $fetch['EmerControllerTel'], "'/></td>"
            , "<td><input style='height:20px;width:250px;' value='", $fetch['HinkleyHealthTel'], "'/></td>";
            echo "</tr></table>";
            echo "<table class='table1'><tr>"
            , "<td>Security Duty Manager:</td>"
            , "<td>Security Duty Manager Tel:</td></tr>";
            echo "<td> <input  style='height:20px;width:250px;' value='", $fetch['SecDutyMan'], "'/></td>"
            , "<td> <input  style='height:20px;width:250px;' value='", $fetch['SecDutyManTel'], "'/></td>";
            echo "</tr></table>";
        }

        ?>


        <table class="table2">
            <h2> Detailed information of the date selected</h2>
            <tr>
                <td>ID</td>
                <td>Contractor</td>
                <td>Requested Date</td>
                <td>Req By:</td>
                <td>Time of req.</td>
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
            $ReqDate = $_POST['ReqDate'];
            $t = strtotime("$ReqDate +1 day");
            $ReqDate1 = date("Y-m-d", $t);
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
	where c.Reqdate  like '$ReqDate1' and c.Authorised <> 'Not'
	group by c.ID
	order by c.ReqDate");


            while ($query_data = mysqli_fetch_row($result)) {
                $DayNum1 +=$query_data['6'];
                $NightNum1 +=$query_data['7'];
                //$total += $query_data[12];
                $Link = "<a href='ww_detail.php?ID=$query_data[0]'>";

                if($query_data[13]=='Not'){$bckcolour='Red';}else{$bckcolour='';}
                echo "<tr>";
                echo "<td>", $query_data[0], "</td>",
                "<td bgcolor='$bckcolour'>", $query_data[1], "</td>",
                "<td>", $query_data[2], "</a></td>",
                "<td>", $query_data[15], "</td>",
                "<td>", $query_data[16], "</td>",
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
                "<td bgcolor='$bckcolour'>", $query_data[13], "</td>",
                "<td>", $query_data[14], "</td>";

                echo "</tr>";


            }

            echo"</table>";

            echo "<tr><td bgcolor='black'>
            <td bgcolor='black'>
            <td bgcolor='black'></td></td></td>
            <td bgcolor='#eee8aa'>Day Totals : </td>
            <td bgcolor='#eee8aa'>". $DayNum1 . "</td>
            <td bgcolor='#eee8aa'>Night Numbers :</td>
            <td bgcolor='#eee8aa'>" .$NightNum1 . "</td></tr>";
            mysqli_free_result($result);
            mysqli_close($connection);


            }

        ?>




    <!-- Clean up. -->
    <?php



    ?>
            <script type="text/javascript">
                //$('#employees').tableExport();
                $(function(){
                    $('#example').DataTable();
                });
            </script>
</body>
</html>

