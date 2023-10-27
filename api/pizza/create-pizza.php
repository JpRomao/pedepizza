<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$name = $_POST['name'];
$image = $_POST['image'];
$ingredientsIds = $_POST['ingredientsIds'];

if (isset($name) && isset($image) && isset($ingredients)) {
  $sql = "INSERT INTO pizza (name, image) VALUES ('$name', '$image')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $pizzaId = mysqli_insert_id($conn);

    foreach ($ingredientsIds as $ingredientId) {
      $sql = "INSERT INTO pizza_ingredient (pizza_id, ingredient_id) VALUES ('$pizza_id', '$ingredientId')";

      $result = mysqli_query($conn, $sql);
    }

    $response = array(
      'status' => 1,
      'message' => 'Pizza added successfully.'
    );
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Pizza addition failed.'
    );
  }
} else {
  $response = array(
    'status' => 0,
    'message' => 'All fields are required.'
  );
}

echo json_encode($response);
exit(1);
