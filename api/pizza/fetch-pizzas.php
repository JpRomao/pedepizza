<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../db/db.php';

$conn = connect();

$sql = 'SELECT id, name, image FROM pizzas ORDER BY NAME ASC';

$result = query($conn, $sql);

$pizzas = fetch($result);

close($conn);

echo json_encode($pizzas);
exit(1);
