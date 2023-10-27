<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$pizzaId = $_POST['pizzaId'];

if (isset($pizzaId)) {
  $sql = "DELETE FROM pizza WHERE id = '$pizzaId'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $sql = "DELETE FROM pizza_ingredient WHERE pizza_id = '$pizzaId'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $response = array(
        'status' => 1,
        'message' => 'Pizza deleted successfully.'
      );
    } else {
      $response = array(
        'status' => 0,
        'message' => 'Pizza deletion failed.'
      );
    }
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Pizza deletion failed.'
    );
  }
} else {
  $response = array(
    'status' => 0,
    'message' => 'Pizza id is required.'
  );
}

echo json_encode($response);
exit(1);
