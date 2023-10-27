<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$ingredientId = $_POST['ingredientId'];
$newName = $_POST['newName'];
$newImage = $_POST['newImage'];

if (isset($ingredientId) && isset($newName) && isset($newImage)) {
  $sql = "UPDATE ingredient SET name = '$newName', image = '$newImage' WHERE id = '$ingredientId'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $response = array(
      'status' => 1,
      'message' => 'Ingredient updated successfully.'
    );
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Ingredient update failed.'
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
