<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$pizzaId = $_POST['pizzaId'];
$ingredientsIds = $_POST['ingredientsIds'];
$newName = $_POST['newName'];

if (isset($pizzaId) && isset($ingredientsIds) && isset($newName)) {
  $sql = "UPDATE pizza SET name = '$newName' WHERE id = '$pizzaId'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $sql = "DELETE FROM pizza_ingredient WHERE pizza_id = '$pizzaId'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      foreach ($ingredientsIds as $ingredientId) {
        $sql = "INSERT INTO pizza_ingredient (pizza_id, ingredient_id) VALUES ('$pizzaId', '$ingredientId')";

        $result = mysqli_query($conn, $sql);
      }

      $response = array(
        'status' => 1,
        'message' => 'Pizza updated successfully.'
      );
    } else {
      $response = array(
        'status' => 0,
        'message' => 'Pizza update failed.'
      );
    }
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Pizza update failed.'
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
