<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
    $Name = $_POST['search'];
?>


<table border="1" cellpadding="2" cellspacing="2"  class="table1">
  <tr>
    <td onclick="sortTable1(0)">ID</td>
    <td onclick="sortTable1(1)">Username</td>
    <td onclick="sortTable1(2)">First Name</td>
    <td onclick="sortTable1(3)">Surname</td>
    <td onclick="sortTable1(4)">Group</td>
    <td onclick="sortTable1(5)">email</td>
    <td onclick="sortTable1(6)">Company</td>
    <td onclick="sortTable1(7)">Daily log</td>
    <td onclick="sortTable1(8)">Weekend Working</td>
    <td onclick="sortTable1(9)">Weekend Working Admin</td>
    <td onclick="sortTable1(10)">Last Logged in</td>

      <?PHP
      print_r($_POST);
      ?>
<?php


$result = mysqli_query($con, "SELECT 
        l.id, 
        l.username,
        l.first,
        l.last, 
        l.group, 
        l.email, 
        l.Company,
        l.DailyLog,
        l.WW,
        l.WWadmin,
        l.logtime 
        FROM login l 
        where l.last LIKE '%$Name%'
        or l.first like '%$Name%'
        or l.Company like '%$Name%'
        or l.username like '%$Name%'  
        order by l.Company");

while ($query_data = mysqli_fetch_row($result)) {
    $Link = "<a href='userdetails.php?ID=$query_data[0]&username=$query_data[1]&first=$query_data[2]&last=$query_data[3]&group=$query_data[4]&email=$query_data[5]&company=$query_data[6]&dailylog=$query_data[7]&ww=$query_data[8]&wwa=$query_data[9]&log=$query_data[10]'>";
//  echo "<table id='Mytable2'>";
    echo "<tr>";
    echo "<td>$Link", $query_data[0], "</td>",
    "<td>$Link", $query_data[1], "</td>",
    "<td>$Link", $query_data[2], "</td>",
    "<td>$Link", $query_data[3], "</td>",
    "<td>", $query_data[4], "</td>",
    "<td>", $query_data[5], "</td>",
    "<td>", $query_data[6], "</td>",
    "<td>", $query_data[7], "</td>",
    "<td>", $query_data[8], "</td>",
    "<td>", $query_data[9], "</td>",
    "<td>", $query_data[10], "</td>";
    echo "</tr>";
    //echo "</table>";

}}
?>

</table>
