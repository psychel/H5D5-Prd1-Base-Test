<?php include "../inc/cdbinfo.inc";
include "WWadmincheck.php";
session_start();?>

<style>


    <?php  include "../style.css";
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
            $database = mysqli_select_db($connection, DB_DATABASE);
// getting variables
     $fullname = $_SESSION['fullname'];
     if(isset($_GET['ID'])){
        $ID                 = $_GET['ID'];
        $Description        = $_GET['Description'];
        $Value              = $_GET['Value'];
        $CID                = $_GET['CID'];
        $Contractor         = $_GET['Contractor'];
      }
      if(isset($_GET['CID'])){
        $CID                = $_GET['CID'];
        $ContractorName         = $_GET['ContractorName'];
        }
      if(isset($_POST['upstatus'])){
        $ID                 = htmlentities($_POST['ID']);
        $Description        = htmlentities($_POST['Description']);
        $Value              = htmlentities($_POST['Value']);

   	UpdateStatus($connection,
                $ID,
                $Description,
                $Value
               );
   echo "<script>window.location='wwadmin.php</script>";
//header("Location:".$url);  UpDateCont
}
      if(isset($_POST['UpDateCont'])){
        $CID                 = htmlentities($_POST['CID']);
        $ContractorName      = htmlentities($_POST['ContractorName']);
   	    UpdateContractor($connection,
                $CID,
                $ContractorName
               );
        echo "<script>window.location='wwadmin.php</script>";
    }
      if(isset($_POST['AddCont'])){
        $NewContractorName      = htmlentities($_POST['NewContractorName']);
   	    AddContractor($connection,
                $NewContractorName
               );
        echo "<script>window.location='wwadmin.php</script>";
    }
      ?>
</style>

<html>
<div class="back">
    <body>
    <h1>Weekend Working Administrator page</h1>

<table class="out">
    <tr>
        <td>Generic Pages</td>
        <td>-------------</td>
        <td>-------------</td>
        <td>Weekend Working</td>
    </tr>
    <tr>
        <td>
        <input type="button" onclick="window.location='../main.php'"
               class="Redirect" value="Main Page"/>
        </td>

        <td>
            <input type="button" onclick="window.location='../admin.php'"
               class="Redirect" value="Admin"/>
        </td>
        <td></td>
        <td>
            <input type="button" onclick="window.location='wwauth.php'"
                   class="Redirect" value="View Authorised"/>

        </td>
        <td>
            <input type="button" onclick="window.location='wwFront.php'"
                   class="Redirect" value="WW Main"/>

        </td>
    </tr>
    <br><br>


    <tr><td>

        </td>
    </tr>
    </table>
<br><br>
    <h2>Main Pages</h2>


    <h2>Please Click on the Static information you wish to change, change as required and press the update button</h2>

    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <table class="table1">
            <tr>
                <td>ID</td>
                <td>Description</td>
                <td>Value</td>
                <td></td>

            </tr>
            <tr>
                <td>
                    <?PHP echo "<input type='text' name='ID' style='height:20px;width:50px;' value='" . $ID ."' readonly />"?>
                </td>
                <td>
                    <?PHP echo "<textarea name='Description' "  .$readonly." style='height:50px;width:150px;' wrap='soft'>" . $Description ."</textarea>"?>

                </td>
                <td>
                    <?PHP echo "<input type='text' name='Value' style='height:20px;width:150px;' value='" . $Value ."'  />"?>
                </td>
                <td><?php if($readonly != 'readonly'){echo ("<input type='submit' name='upstatus' value='Update Status' />");}?></td>
            </tr>
        </table>
        <table class="table1">

            <tr>
                <td>ID</td>
                <td>Description</td>
                <td>Value</td>
            </tr>
<?PHP
            $result = mysqli_query($connection, "SELECT
            c.ID,
            c.Description,
            c.Value
            FROM ww_static as c 
              ");

            while($query_data = mysqli_fetch_row($result)) {
                $Link = "<a href='wwadmin.php?ID=$query_data[0]&"
                    . "Description=$query_data[1]&"
                    . "Value=$query_data[2]
					'>";

                echo "<tr>";
                echo "<td>$Link", $query_data[0], "</td>",
                "<td>$Link", $query_data[1], "</td>",
                "<td>$Link", $query_data[2], "</td>";
                echo "</tr>";
            }
?>

            <?PHP
            function UpdateStatus($connection,
                                  $ID,
                                  $Description,
                                  $Value
                                    )
            {
                $ID1            = mysqli_real_escape_string($connection, $ID);
                $Description1   = mysqli_real_escape_string($connection, $Description);
                $Value1          = mysqli_real_escape_string($connection, $Value);
                $Startquery = "update ww_static set   
                Value='$Value1',
                Description ='$Description1'

        where id='$ID1'";
                if(!mysqli_query($connection, $Startquery)) echo("<p>Error updating Status.</p>");
            }
            ?>
        </table>
        <table class="table1">
            <h2>Add a new contractor</h2>
            <tr>
                <td>New Contractor Name</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <?PHP echo "<textarea name='NewContractorName' "  .$readonly." style='height:50px;width:150px;' wrap='soft'></textarea>"?>
                </td>
                <td><?php if($readonly != 'readonly'){echo ("<input type='submit' name='AddCont' value='Add Contractor' />");}?></td>
                </td>
            </tr>
        </table>




        <table class="table1">
            <h2>Please click on contractor , change and press update button</h2>
            <tr>
                <td>ID</td>
                <td>Contractor Name</td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>
                    <?PHP echo "<input type='text' name='CID' style='height:20px;width:50px;' value='" . $CID ."' readonly />"?>
                </td>
                <td>
                    <?PHP echo "<textarea name='ContractorName' "  .$readonly." style='height:50px;width:150px;' wrap='soft'>" . $ContractorName ."</textarea>"?>

                </td>

                <td><?php if($readonly != 'readonly'){echo ("<input type='submit' name='UpDateCont' value='Update Name' />");}?></td>

            </tr>
        </table>
        <table class="table1">
            <tr>
                <td>ID</td>
                <td>Company</td>

            </tr>
            <?PHP
            $cresult = mysqli_query($connection, "SELECT
            c.ID,
            c.ContractorName
            FROM contractors as c 
              ");

            while($query_data = mysqli_fetch_row($cresult)) {
                $Link = "<a href='wwadmin.php?CID=$query_data[0]&"
                    . "ContractorName=$query_data[1]'>";

                echo "<tr>";
                echo "<td>$Link", $query_data[0], "</td>",
                "<td>$Link", $query_data[1], "</td>";
                echo "</tr>";
            }
            ?>
            <!-- Clean up. -->
            <?php
            mysqli_free_result($result);
            mysqli_free_result($cresult);
            mysqli_close($connection);
            ?>
            <?PHP
            function UpdateContractor($connection,
                                  $CID,
                                  $ContractorName
            )
            {
                $CID1            = mysqli_real_escape_string($connection, $CID);
                $ContractorName1   = mysqli_real_escape_string($connection, $ContractorName);
                $Startquery = "update contractors set   
                  ContractorName='$ContractorName1'
                  where id='$CID1'";
                if(!mysqli_query($connection, $Startquery)) echo("<p>Error updating Contractor Name.</p>");
            }
            function AddContractor($connection,
                                      $NewContractorName
                                )
            {
                $NewContractorName1   = mysqli_real_escape_string($connection, $NewContractorName);
                $Startquery = "Insert into contractors (ContractorName)
                              Values   
                                            ('$NewContractorName1');";
                if(!mysqli_query($connection, $Startquery)) echo("<p>Error updating Contractor Name.</p>");
            }
            ?>
        </table>
</form>




</body>
</div>
</html>

<?php
include "../foot.php";
?>
