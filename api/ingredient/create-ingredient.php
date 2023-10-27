<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use db as db;

$conection = db\connect();

$name = $_POST['name'];
$image = $_POST['image'];

if (isset($name) && isset($image)) {
  $sql = "INSERT INTO ingredient (name, image) VALUES ('$name', '$image')";

  $result = mysqli_query($conection, $sql);

  if ($result) {
    $response = array(
      'status' => 1,
      'message' => 'Ingredient added successfully.'
    );
  } else {
    $response = array(
      'status' => 0,
      'message' => 'Ingredient addition failed.'
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
