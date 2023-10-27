<?php
include_once './functions/key.php';

if (isset($_COOKIE['key']) && !verifyKeyIsValid($_COOKIE['key'])) {
  setcookie('key', '', time() - 3600);
  header('Location: login-page.php');
}

if (
  !isset($_COOKIE['key'])
  &&
  !strpos($_SERVER['REQUEST_URI'], 'login-page.php')
) {
  header('Location: login-page.php');
}
?>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">