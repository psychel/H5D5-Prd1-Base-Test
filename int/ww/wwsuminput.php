<?php include "../inc/cdbinfo.inc";
include "compcheck.php";
session_start();?>

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
<html>
<div class="back">
<body>
<h1>HPC Summary information page</h1>

<input type="button" onclick="window.location='wwFront.php'"
       class="Redirect" value="WW Main Page"/>
<input type="button" onclick="window.location='wwauth.php'"
       class="Redirect" value="WW Authorised"/>
<input type="button" onclick="window.location='../main.php'"
       class="Redirect" value="Main Page"/>
<h2> Please Enter New Weekend Working Request</h2>


<?php


  /*function to send to sql command*/

 if(isset($_POST['add']))
 {
     $ReqDate                   =       htmlentities($_POST['ReqDate']);
     $ConDutyMan                =       htmlentities($_POST['ConDutyMan']);
     $ConDutyManTel             =       htmlentities($_POST['ConDutyManTel']);
     $ConDutyManEmail           =       htmlentities($_POST['ConDutyManEmail']);
     $SODutyMan                 =       htmlentities($_POST['SODutyMan']);
     $SODutyManTel              =       htmlentities($_POST['SODutyManTel']);
     $SODutyManEmail            =       htmlentities($_POST['SODutyManEmail']);
     $HSDutyMan                 =       htmlentities($_POST['HSDutyMan']);
     $HSDutyManTel              =       htmlentities($_POST['HSDutyManTel']);
     $HSDutyManEmail            =       htmlentities($_POST['HSDutyManEmail']);
     $ENVDutyMan                =       htmlentities($_POST['ENVDutyMan']);
     $ENVDutyManTel             =       htmlentities($_POST['ENVDutyManTel']);
     $ENVDutyManEmail           =       htmlentities($_POST['ENVDutyManEmail']);
     $EmerController            =       htmlentities($_POST['EmerController']);
     $EmerControllerTel         =       htmlentities($_POST['EmerControllerTel']);
     $HinkleyHealthTel          =       htmlentities($_POST['HinkleyHealthTel']);
     $SecDutyMan                =       htmlentities($_POST['SecDutyMan']);
     $SecDutyManTel             =       htmlentities($_POST['SecDutyManTel']);

     // SQL script to push the data in

     $ReqDate1                   =       mysqli_real_escape_string($connection, $ReqDate);
     $ConDutyMan1                =       mysqli_real_escape_string($connection, $ConDutyMan);
     $ConDutyManTel1             =       mysqli_real_escape_string($connection, $ConDutyManTel);
     $ConDutyManEmail1           =       mysqli_real_escape_string($connection, $ConDutyManEmail);
     $SODutyMan1                 =       mysqli_real_escape_string($connection, $SODutyMan);
     $SODutyManTel1              =       mysqli_real_escape_string($connection, $SODutyManTel);
     $SODutyManEmail1            =       mysqli_real_escape_string($connection, $SODutyManEmail);
     $HSDutyMan1                 =       mysqli_real_escape_string($connection, $HSDutyMan);
     $HSDutyManTel1              =       mysqli_real_escape_string($connection, $HSDutyManTel);
     $HSDutyManEmail1            =       mysqli_real_escape_string($connection, $HSDutyManEmail);
     $ENVDutyMan1                =       mysqli_real_escape_string($connection, $ENVDutyMan);
     $ENVDutyManTel1             =       mysqli_real_escape_string($connection, $ENVDutyManTel);
     $ENVDutyManEmail1           =       mysqli_real_escape_string($connection, $ENVDutyManEmail);
     $EmerController1            =       mysqli_real_escape_string($connection, $EmerController);
     $EmerControllerTel1         =       mysqli_real_escape_string($connection, $EmerControllerTel);
     $HinkleyHealthTel1          =       mysqli_real_escape_string($connection, $HinkleyHealthTel);
     $SecDutyMan1                =       mysqli_real_escape_string($connection, $SecDutyMan);
     $SecDutyManTel1             =       mysqli_real_escape_string($connection, $SecDutyManTel);

     $VarCodeQuery = "insert into ww_sum (
            ReqDate,
            ConDutyMan,
            ConDutyManTel,
            ConDutyManEmail,
            SODutyMan,
            SODutyManTel,
            SODutyManEmail,
            HSDutyMan,
            HSDutyManTel,
            HSDutyManEmail,
            ENVDutyMan,
            ENVDutyManTel,
            ENVDutyManEmail,
            EmerController,
            EmerControllerTel,
            HinkleyHealthTel,
            SecDutyMan,
            SecDutyManTel
            
                ) values (
                STR_TO_DATE('$ReqDate1','%d-%m-%Y'),
                '$ConDutyMan1',
                '$ConDutyManTel',
                '$ConDutyManEmail1',
                '$SODutyMan1',
                '$SODutyManTel1',
                '$SODutyManEmail1',
                '$HSDutyMan1',
                '$HSDutyManTel1',
                '$HSDutyManEmail1',
                '$ENVDutyMan1',
                '$ENVDutyManTel1',
                '$ENVDutyManEmail1',
                '$EmerController1',
                '$EmerControllerTel1',
                '$HinkleyHealthTel1',
                '$SecDutyMan1',
                '$SecDutyManTel1'
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
    <table border=0>
        <p></p>
    Notes: This form must be submitted every Wednesday by 15:00
    </table>
  <table class="table2">
    <tr>
        <tr>
            <td>
            Date of Work:
            </td>
            <td>
                <input type='text' autocomplete="Off" class='tcal' name='ReqDate' style='height:20px;width:120px;background-color: white;'  />
            </td>
        </tr>
      <tr>
          <td>
              Construction Duty Manager:
          </td>
          <td>
              <input type='text' name='ConDutyMan' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
              Construction Duty Manager Tel:
          </td>
          <td>
              <input type='text' name='ConDutyManTel' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
              Construction Duty Manager Email:
          </td>
          <td>
              <input type='text' name='ConDutyManEmail' style='height:20px;width:400px;'  />

          </td>
        </tr>

      <tr>
          <td>
              Site Ops Duty Manager:
          </td>
          <td>
              <input type='text' name='SODutyMan' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
              Site Ops Duty Manager Tel:
          </td>
          <td>
              <?PHP
              $res = mysqli_query($connection,
                  "select ID,Value,Description
                                    from ww_static 
                                  " );

              if(mysqli_num_rows($res)){
                  $select= '<select name="SODutyManTel" onchange="reload(this.form)">';
                  $select.= " <option value=''></option>";
                  while($rs=mysqli_fetch_array($res)){
                      if($rs['ID']!=''){
                          $select .= '<option value="' . $rs['ID'] . '" ';
                          if ($_POST['SODutyManTel'] == $rs['ID']) {
                              $select .= ' selected = "selected"';
                          }
                          $select .= '>' . $rs['Description'] . " - " .$rs['Value'] . '</option>';
                      }
                  }
              }
              $select.='</select>';
              echo $select;

              ?>

          </td>
      </tr>
      <tr>
          <td>
               Site Ops Duty Manager Email:
          </td>
          <td>
              <input type='text' name='SODutyManEmail' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
              Health And Safety Duty Manager
          </td>
          <td>
              <input type='text' name='HSDutyMan' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
             Health and Safety Duty Manager Tel:
          </td>
          <td>
              <input type='text' name='HSDutyManTel' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
             Health and Safety Duty Manager Email:
          </td>
          <td>
              <input type='text' name='HSDutyManEmail' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
              Eviromental Advisor:
          </td>
          <td>
              <input type='text' name='ENVDutyMan' style='height:20px;width:400px;'  />
          </td>
      </tr>
      <tr>
          <td>
              Environmental Advisor Tel:
          </td>
          <td>
              <input type='text' name='ENVDutyManTel' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
              Environmental Advisor Email
          </td>
          <td>
              <input type='text' name='ENVDutyManEmail' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
              Emergency Controller:
          </td>
          <td>
              <input type='text' name='EmerController' style='height:20px;width:400px;'  />
          </td>
      </tr>      <tr>
          <td>
              Emergency Controller Tel:
          </td>
          <td>
              <input type='text' name='EmerControllerTel' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
              Hinkley Health Tel:
          </td>
          <td>

              <?PHP
              $res = mysqli_query($connection,
                  "select ID,Value,Description
                                    from ww_static 
                                  " );

              if(mysqli_num_rows($res)){
                  $select= '<select name="HinkleyHealthTel" onchange="reload(this.form)">';
                  $select.= " <option value=''></option>";
                  while($rs=mysqli_fetch_array($res)){
                      if($rs['ID']!=''){
                          $select .= '<option value="' . $rs['ID'] . '" ';
                          if ($_POST['HinkleyHealthTel'] == $rs['ID']) {
                              $select .= ' selected = "selected"';
                          }
                          $select .= '>' . $rs['Description'] . " - " .$rs['Value'] . '</option>';
                      }
                  }
              }
              $select.='</select>';
              echo $select;

              ?>
          </td>
      </tr>
      <tr>
          <td>
              Duty Security Manager:
          </td>
          <td>
              <input type='text' name='SecDutyMan' style='height:20px;width:400px;'  />
          </td>
      </tr>

      <tr>
          <td>
              Duty Security Tel:
          </td>
          <td>
              <input type='text' name='SecDutyManTel' style='height:20px;width:400px;'  />
          </td>
      </tr>

  </table>
                <input type="submit" name="add" value="Add new request" style='height:100px;width:250px;' />


  

   
<!-- Display table data. -->

</form>
<!-- Clean up. -->
<?php

  //mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</div>
</html>

<?php
include "../foot.php";
?>
