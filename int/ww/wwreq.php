<?php include "../inc/cdbinfo.inc";
include "WWcheck.php";
?>

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
     $company = $_SESSION['Company'];



    ?>
</style>
<html>
<div class="back">
<body>
<h1>Weekend Working Contractor Request Form </h1>
<input type="button" onclick="window.location='wwFront.php'"
       class="Redirect" value="WW Main Page"/>


<h2>       Please Enter New Weekend Working Request </h2>
<h3>Do not press the enter button on the keyboard until you are complete.  Use the TAB button to negotiate the fields</h3>

<?php print_r($_POST); ?>
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
     $Requester                 =       htmlentities($fullname);
     echo $_POST;
     if (empty($daynum)){ $daynum=0;}
     if (empty($nightnum)) {$nightnum=0;}

     // checking for blank values
     $contractor_blank                =       trim($contractor);
     $reqdate_blank                   =       trim($reqdate);
     $areas_blank                     =       trim($areas);
     $task_blank                      =       trim($task);
     $super_blank                     =       trim($super);
     $daynum_blank                    =       trim($daynum);
     $nightnum_blank                  =       trim($nightnum);
     $aiders_blank                    =       trim($aiders);
     $plant_blank                     =       trim($plant);
     $ConDutyMan_blank                =       trim($ConDutyMan);
     $ConDutyManPos_blank             =       trim($ConDutyManPos);
     $ConDutyManCont_blank            =       trim($ConDutyManCont);

     $error=false;

    // blank checking and blank value generating
     if(empty($contractor_blank))
     {
         $error_contractor_blank = 'Contractor is empty';
         $error=true;
     }
     if(empty($reqdate_blank))
     {
         $error_reqdate_blank = 'Required Date is empty';
         $error=true;
     }
     if(empty($areas_blank))
     {
         $error_areas_blank = 'Area is empty';
         $error=true;
     }
     if(empty($task_blank))
     {
         $error_task_blank = 'Task field is empty';
         $error=true;
     }
     if(empty($super_blank))
     {
         $error_super_blank = 'Supervisor is empty';
         $error=true;
     }
     if(empty($daynum_blank))
     {
         $error_daynum_blank = 'Day Numbers is empty';
         $error=true;
     }
     if(empty($nightnum_blank))
     {
         $error_nightnum_blank = 'Night Number is empty';
         $error=true;
     }
     if(empty($aiders_blank))
     {
         $error_aiders_blank = 'First Aiders is empty';
         $error=true;
     }
     if(empty($plant_blank))
     {
         $error_plant_blank = 'Plant is empty';
         $error=true;
     }
     if(empty($ConDutyMan_blank))
     {
         $error_ConDutyMan_blank = 'Duty Manager is empty';
         $error=true;
     }
     if(empty($ConDutyManPos_blank))
     {
         $error_ConDutyManPos_blank = 'Manager Position is empty';
         $error=true;
     }
     if(empty($ConDutyManCont_blank))
     {
         $error_ConDutyManCont_blank = 'Manager Contact is empty';
         $error=true;
     }
// If no blanks do script
if($error==true){
    $errorTime='Please enter the time required again';

}
if(false === $error)
{
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
                Now()
                        );";

     if(!mysqli_query($connection, $VarCodeQuery)) {
         echo("<p>Error updating data. </p>".$daynum );
     }else{
         echo ("<p>The activity $description has been added.</p>");
     }

 }}

?>


<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">

    <table border=0>
        <p></p>
    Notes: This form must be submitted every Wednesday by 15:00
        <div id="error" style="display:none">Fill all the textboxes</div>
    </table>
  <table class="table2">
    <tr>
        <tr>
            <td>
            Contractor
            </td>

          <td>
              <?PHP
              if($company=='NNB'){
              $res = mysqli_query($connection,
                  "select distinct (ContractorName)
                                    from contractors 
                                  " );

              if(mysqli_num_rows($res)){
                  $select= '<select name="contractor" onchange=\"reload(this.form)\">';
                  $select.= " <option value=''>Select</option>";
                  while($rs=mysqli_fetch_array($res)){
                      if($rs['ContractorName']!=''){
                          $select .= '<option value="' . $rs['ContractorName'] . '" ';
                          if ($_POST['contractor'] == $rs['ContractorName']) {
                              $select .= ' selected = "selected"';
                          }
                          $select .= '>' . $rs['ContractorName'] . '</option>';
                      }
                  }
              }
              $select.='</select>';
              echo $select;}else{
                  ?>
               <input type='text' readonly name='contractor' value='<?PHP echo $company?>' style='height:20px;width:400px;'  />
          <?PHP
              }





              ?><?php echo $error_contractor_blank ?>
          </td>
        </tr>
      <tr>
          <td>
              Date Requested For
          </td>
          <td>
              <input type='text' autocomplete='off' class='tcal' name='reqdate' style='height:20px;width:120px;background-color: white;'  />
              <?php echo $error_reqdate_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              Areas of Work:
          </td>
          <td>
              <input type='text' name='areas' style='height:20px;width:400px;'  />
              <?php echo $error_areas_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              Tasks:
          </td>
          <td>
              <textarea name='task'  style='height:100px;width:400px;' wrap='soft'></textarea>
              <?php echo $error_task_blank ?>

          </td>
        </tr>

      <tr>
          <td>
              Supervisors Name And Contact Details:
          </td>
          <td>
              <textarea name='super'  style='height:100px;width:400px;' wrap='soft'></textarea>
              <?php echo $error_super_blank ?>
          </td>
      </tr>

      <tr>
          <td>
              Day Workforce Numbers
          </td>
          <td>
              <input type='number' name='daynum' style='height:20px;width:100px;' onkeypress="return isNumberKey(event)" />
              <?php echo $error_daynum_blank ?>
          </td>
      </tr>
      <tr>
          <td>
           Night Workforce Numbers
          </td>
          <td>
              <input type='number' name='nightnum' style='height:20px;width:100px;' onkeypress="return isNumberKey(event)" />
              <?php echo $error_nightnum_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              First Aiders Name And Contact Details:
          </td>
          <td>
              <textarea name='aiders'  style='height:100px;width:400px;' wrap='soft'></textarea>
              <?php echo $error_aiders_blank ?>
          </td>
      </tr>

      <tr>
          <td>
              Plant in Use:
          </td>
          <td>
              <textarea name='plant'  style='height:100px;width:400px;' wrap='soft'></textarea>
              <?php echo $error_plant_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              Contractor Duty Manager
          </td>
          <td>
              <input type='text' name='ConDutyMan' style='height:20px;width:400px;'  />
              <?php echo $error_ConDutyMan_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              Contractors Duty Managers Position
          </td>
          <td>
              <input type='text' name='ConDutyManPos' style='height:20px;width:400px;'  />
              <?php echo $error_ConDutyManPos_blank ?>
          </td>
      </tr>
      <tr>
          <td>
              Contractor Duty Manager Contacts details
          </td>
          <td>
              <input type='text' name='ConDutyManCont' style='height:20px;width:400px;'  />
              <?php echo $error_ConDutyManCont_blank ?>
          </td>
      </tr>

</table>
                <input type="submit" id="btnSubmit" name="add" value="Add new activity" style='height:100px;width:250px;' />


  

   
<!-- Display table data. -->

</form>
<!-- Clean up. -->
<?php

  //mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html></div>

<?php
include "../foot.php";
?>


