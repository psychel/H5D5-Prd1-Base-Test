<?php  ?>
<?php  ?>
<style>
    <?php include "WWcheck.php";

include "../style.css";
?>
</style>

<?php


?>


<html>
<div class="back">
<body>

<h1>Welcome to the Weekend Working Main Page</h1>

<br>



<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
    <table border="0">
<tr><td>Contractor</td></tr>
        <div class="aligncenter" style="width:80%;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
        <tr>
            <td>
            <input type="button" onclick="window.location='wwreq.php'"
                   class="Redirect" value="Contractor Req Form"/>
            </td>
            <td>
                <input type="button" onclick="window.location='wwContStatus.php'"
                       class="Redirect" value="See Contractors Req and Status"/>
            </td>

        </tr>
    </table><table><tr><td>HPC</td></tr>
        <div class="aligncenter" style="width:80%;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
        <tr>
            <td>
                <input type="button" onclick="window.location='wwsuminput.php'"
                       class="Redirect" value="HPC Summary Information"/>
            </td>
            <td>
                <input type="button" onclick="window.location='ww2auth.php'"
                       class="Redirect" value="Pending"/>
            </td>
            <td>
                <input type="button" onclick="window.location='wwauth.php'"
                       class="Redirect" value="View Authorised"/>
            </td>
            <td>
                <input type="button" onclick="window.location='upcoming.php'"
                       class="Redirect" value="View Upcoming"/>
            </td>
            <td>
                <input type="button" onclick="window.location='wwadmin.php'"
                       class="Redirect" value="WW Admin"/>
            </td>
        </tr>

    </table><table><tr><td>All</td></tr>
        <div class="aligncenter" style="width:80%;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>

        <td>
            <input type="button" onclick="window.location='wwsumm.php'"
                   class="Redirect" value="Weekend working info"/>
        </td>
    </table><table><tr><td>Go Back</td></tr>
        <div class="aligncenter" style="width:80%;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>

        <td>
            <input type="button" onclick="window.location='../main.php'"
                   class="Redirect" value="Main Page"/>
        </td>

    </table>
</form>
<div class="aligncenter" style="width:80%;height:0;border-top:2px dotted #880088;font-size:0;">-</div><br>
</body>
</div>
</html>
<?php
include "../foot.php";
?>
