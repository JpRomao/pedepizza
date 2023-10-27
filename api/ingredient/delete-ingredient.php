<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$ingredientId = $_POST['ingredientId'];

if (isset($ingredientId)) {
  $sql = "DELETE FROM ingredient WHERE id = '$ingredientId'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $response = array(
      'status' => 1,
      'message' => 'Ingredient deleted successfully.'
    );
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Ingredient deletion failed.'
    );
  }
} else {
  $response = array(
    'status' => 0,
    'message' => 'Ingredient ID is required.'
  );
}

echo json_encode($response);
exit(1);
