<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
    $Name = $_POST['search'];
//Search query.
    $Query = "SELECT last FROM login WHERE last LIKE '%$Name%' LIMIT 5";
//Query execution
    $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
/*    echo '<ul>';
    //Fetching result from database.
    while ($Result = MySQLi_fetch_array($ExecQuery)) {
        */?><!--
        <!-- Creating unordered list items.
             Calling javascript function named as "fill" found in "script.js" file.
             By passing fetched result as parameter. -->
        <li onclick='fill("<?php /*echo $Result['last']; */?>")'>
            <a>
                <!-- Assigning searched result in "Search box" in "search.php" file. -->
                <?php /*echo $Result['last'];
                $LastName = $Result['last'];*/?>
        </li></a>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->
        --><?php
/*    }}*/
    ?>


<table border="1" cellpadding="2" cellspacing="2" id="myTable1" class="table1">
  <tr>
    <td onclick="sortTable1(0)">ID</td>
    <td onclick="sortTable1(1)">Username1</td>
    <td onclick="sortTable1(2)">First Name</td>
    <td onclick="sortTable1(3)">Surname</td>
    <td onclick="sortTable1(4)">Group</td>
    <td onclick="sortTable1(5)">email</td>
    <td onclick="sortTable1(6)">Company</td>
    <td onclick="sortTable1(7)">Daily log</td>
    <td onclick="sortTable1(8)">Weekend Working</td>
    <td onclick="sortTable1(9)">Weekend Working Admin</td>


<?php


$result = mysqli_query($connection, "SELECT 
        l.id, 
        l.username,
        l.first,
        l.last, 
        l.group, 
        l.email, 
        l.Company,
        l.DailyLog,
        l.WW,
        l.WWadmin 
        FROM login l 
        where l.last LIKE '%$Name%'
        order by l.Company");

while ($query_data = mysqli_fetch_row($result)) {
    $Link = "<a href='change.php?ID=$query_data[0]&user=$query_data[1]&cemail=$query_data[5]&Company=$query_data[6]&WW=$query_data[7]&WWadmin=$query_data[8]'>";
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
    "<td>", $query_data[9], "</td>";
    echo "</tr>";
    //echo "</table>";

}}
?>

</table>
