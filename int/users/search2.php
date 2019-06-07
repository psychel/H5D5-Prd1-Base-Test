<?php

$host = 'localhost';
$user = 'ADMIN';
$password = 'D8rbu51234';
$database = 'int';

$mysqli = new mysqli($host, $user, $password, $database);

$username = $_GET['username'];
$startFrom = $_GET['startFrom'];

$username = trim(htmlspecialchars($username));
$startFrom = filter_var($startFrom, FILTER_VALIDATE_INT);

$like = '%' . strtolower($username) . '%';
$statement = $mysqli -> prepare('
	SELECT username, first, last 
	FROM login 
	WHERE lower(name) LIKE ?  
	ORDER BY INSTR(title, ?), title
	LIMIT 6 OFFSET ?'
);

if (
    $statement &&
    $statement -> bind_param('ssi', $like, $username, $startFrom) &&
    $statement -> execute() &&
    $statement -> store_result() &&
    $statement -> bind_result($username, $first, $last)
) {
    $array = [];
    while ($statement -> fetch()) {
        $array[] = [
            'username' => $username,
            'first' => $first,
            'last' => $last
        ];
    }
    echo json_encode($array);
    exit();
}