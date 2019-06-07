<?PHP
 include "../inc/cdbinfo.inc";
//version 1.3
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);


if(isset($_POST['Submit'])){
    print_r($_POST);
$number = count($_POST['boxes']);
    $plant = $_POST['boxes'];

    echo '<script language="javascript">';
    echo 'alert("message successfully sent" '& $plant &')';
    echo '</script>';
    echo $number;

    for ($i=0;$i<count($_POST['boxes']);$i++){
$test = $_POST['boxes'][$i];
echo $test;
        $test1      = mysqli_real_escape_string($connection, $test);
        $VarCodeQuery = "insert into int.ww_aow (
          contractor
                ) values (
                '$test1'
                        );";

        if (!mysqli_query($connection, $VarCodeQuery)) {
            echo("<p>Error updating data.</p>");
        } else {
            echo("<p>The activity $description has been added.</p>");
        }
    }
}

?>