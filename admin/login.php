<?php
$user = $_POST['username'];
$pass = $_POST['password'];

include_once './functions/key.php';

/**
 * TODO:
 * 1. Check if the user is admin
 * 2. If the user is admin set cookie and redirect to admin.php
 * 3. If the user is not admin, redirect to login.php
 */

if ($user == 'admin' && $pass == 'admin') {
  setcookie('key', generateKey(), time() + 60 * 60 * 2, '/'); // 2 hours
  header('Location: index.php');
} else {
  header('Location: login.php');
}
