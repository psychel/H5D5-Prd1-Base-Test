<?php
/**
 * Created by PhpStorm.
 * User: Russell
 * Date: 20/08/2018
 * Time: 11:21
 */
function F_link(){

    $Link = "<a href='dataro3.php?day=$day&
		ID=$query_data[0]&"
        . "company=$query_data[1]&"
        . "dept=$query_data[2]&"
        . "zone1=$query_data[3]&"
        . "platform1=$query_data[4]&"
        . "area=$query_data[5]&"
        . "subarea=$query_data[6]&"
        . "layer=$query_data[7]&"
        . "Plant=$query_data[8]&"
        . "description=$query_data[9]&"
        . "c1=$query_data[10]&"
        . "c2=$query_data[12]&"
        . "c3=$query_data[13]&"
        . "qra=$query_data[14]&"
        . "crit=$query_data[15]&"
        . "reqamt=$query_data[16]&"
        . "reqdate=$query_data[17]&"
        . "reqtime=$query_data[18]&"
        . "supplyrate=$query_data[19]&"
        . "foretime=$query_data[20]&"
        . "status=$query_data[21]&"
        . "comments=$query_data[22]&"
        . "contact=$query_data[23] &"
        . "CallTime=$query_data[11]&"
        . "actamt=$query_data[27]&"
        . "mix=$query_data[28]
					'>";

}


function F_colours($col)
{
    if (strtolower($col) == strtolower('BOP')) {
        $bckcolour = 'hotpink';
    }
    elseif (strtolower($col) == strtolower('NI')) {
        $bckcolour = 'purple';
    }
    elseif (strtolower($col) == strtolower('HS')) {
        $bckcolour = 'orangered';
    }
    elseif (strtolower($col) == strtolower('CI')) {
        $bckcolour = 'orangered';
    }
    elseif (strtolower($col) == strtolower('services')) {
        $bckcolour = 'green';
    }

    elseif ($col == 'RAN') {
        $bckcolour = 'Pink';
    } elseif ($col == 'STR') {
        $bckcolour = 'powderblue';
    } elseif ($col == 'PGS') {

        $bckcolour = 'lightgreen';
    } elseif (strtolower($col) == strtolower('Denys')) {

        $bckcolour = 'Sienna';
    } elseif ($col == 'Costain') {
        $bckcolour = 'Peru';
    } elseif (strtolower($col) == strtolower('Balfours')) {
        $bckcolour = 'blue';
    } elseif (strtolower($col) == strtolower('Balfour')) {
        $bckcolour = 'blue';
    } else {
        $bckcolour = 'green';
    }


    return $bckcolour;
}
//colour of the status based on options
function F_status($Statuscol){
    if ($Statuscol == 'Started') {

        $StatusColour = 'lightgreen';
    } elseif ($Statuscol == 'Finished') {
        $StatusColour = 'powderblue';
    } elseif ($Statuscol == 'Cancelled') {

        $StatusColour = 'yellow';
    } elseif ($Statuscol == 'No Contact') {
        $StatusColour = 'Red';
    }elseif ($Statuscol == 'Postponed') {
        $StatusColour = 'pink';
    }elseif ($Statuscol == 'Carryover') {
        $StatusColour = 'orange';
    }
    else {
        $StatusColour = '';
    }
    return $StatusColour;
}
?>

<script>


    function sortTable2(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
    function sortTable1(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable1");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

