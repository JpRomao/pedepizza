<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$ingredientsIds = $_GET['ingredientsIds'];
$start = $_GET['start'];
$end = $_GET['end'];

require_once '../../db/db.php';

$conection = connect();

//select all pizzas from database wich have all ingredients from $ingredients array with inner join

$sql = "SELECT p.id, p.name, p.image, GROUP_CONCAT(i.name) AS ingredients
FROM pizzas_ingredients AS pi
INNER JOIN pizzas AS p ON pi.id_pizza = p.id
INNER JOIN ingredients AS i ON pi.id_ingredient = i.id
WHERE pi.id_ingredient IN ($ingredientsIds)
GROUP BY p.id
LIMIT $start, $end";

$result = query($conection, $sql);

$pizzas = fetch($result);

close($conection);

echo json_encode($pizzas);

// if ($result) {
// $response = array(
//   'status' => 200,
//   'message' => 'Pizzas fetched successfully.',
//   'data' => array()
// );

// while ($row = fetch($result)) {
//   array_push($response['data'], $row);
// }

// } else {
// $response = array(
//   'status' => 401,
//   'message' => 'Pizzas fetch failed.'
// );
// }

// echo json_encode($response);

exit(1);
