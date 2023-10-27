<?php
function connect()
{
  // $config = parse_ini_file('../env.ini');

  $config = [
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'pedepizza'
  ];

  $db_host = $config['DB_HOST'];
  $db_user = $config['DB_USER'];
  $db_pass = $config['DB_PASS'];
  $db_name = $config['DB_NAME'];

  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  if (!$conn) {
    error_log('Connection failed: ' . mysqli_connect_error());
    exit(1);
  }

  return $conn;
}

function close($conn)
{
  mysqli_close($conn);
}

function query($conn, $sql)
{
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    error_log('Query failed: ' . mysqli_error($conn));
    exit(1);
  }

  return $result;
}

function fetch($result)
{
  $rows = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function insert($conn, $table, $data)
{
  $columns = array();
  $values = array();

  foreach ($data as $column => $value) {
    $columns[] = $column;
    $values[] = $value;
  }

  $columns = implode(', ', $columns);
  $values = implode("', '", $values);

  $sql = "INSERT INTO $table ($columns) VALUES ('$values')";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    error_log('Insert failed: ' . mysqli_error($conn));
    exit(1);
  }

  return $result;
}

function update($conn, $table, $data, $id)
{
  $columns = array();

  foreach ($data as $column => $value) {
    $columns[] = "$column = '$value'";
  }

  $columns = implode(', ', $columns);

  $sql = "UPDATE $table SET $columns WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    error_log('Update failed: ' . mysqli_error($conn));
    exit(1);
  }

  return $result;
}

function delete($conn, $table, $id)
{
  $sql = "DELETE FROM $table WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    error_log('Delete failed: ' . mysqli_error($conn));
    exit(1);
  }

  return $result;
}
