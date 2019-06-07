
<?php include "session.php";
?>
<style><?php
include "style.css";
	    $fullname = $_SESSION["fullname"];

?>
</style>
<html>
<div class="back">
<head>
    <!-- some header data -->
    <script language="JavaScript" src="tree_items2.js"></script>
    <script language="JavaScript" src="tree_tpl.js"></script>
    <script language="JavaScript" src="tree.js"></script>
</head>


<img src="https://www.edfenergy.com/sites/default/files/styles/spire_theme_tile_mobile_alternative/public/hpc_cgn_web_logo_crop.png?itok=jKZApJTa" alt="" height="100" width="150"/>
<img width="250" height="50" src="http://darbus.co.uk/Aug17/wp-content/uploads/2017/10/cropped-Darbus.jpg" />


<?php
echo "<h1>Welcome " .$fullname . " to HPC Integrated Toolkit v3  " ;

echo "</h1>";
?>
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">

    <h1>Main Page</h1>
<h2>  Select the Module you want to use</h2>
    <!-- //<script language="JavaScript">
    - //
        new tree (TREE_ITEMS, TREE_TPL);
        //
</script>-->
<br><br><br>
    <div class="aligncenter" style="width:400px;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
    <tr>
        <input type="button" onclick="window.location='ww/wwFront.php'"
               class="Redirect" value="Weekend Working Module"/>
    </tr><br><br>
    <div class="aligncenter" style="width:400px;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>

    <br>
    <div class="aligncenter" style="width:400px;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
    <tr>
        <input type="button" onclick="window.location='users/old_search.php'"
               class="Redirect" value="Search users"/>
    </tr><br>
    <br>
    <div class="aligncenter" style="width:400px;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
    <tr>
        <input type="button" onclick="window.location='admin.php'"
               class="Redirect" value="Administrator (note attempts are logged)"/>
    </tr><br>
</form>
</div>
</html>

<?php
include "foot.php";
?>
