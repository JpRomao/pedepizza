<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../db/db.php';

$start = $_GET['start'];
$end = $_GET['end'];

$conection = connect();

$sql = "SELECT id, name, image FROM ingredients ORDER BY NAME ASC LIMIT $start, $end";

$result = query($conection, $sql);

$ingredients = fetch($result);

close($conection);

echo json_encode($ingredients);
exit(1);
