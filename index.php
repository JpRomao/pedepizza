<?php
$autoload = function ($class) {
  if (file_exists($class . '.php')) {
    include_once $class . '.php';
  } else {
    die('Class ' . $class . ' not found.');
  }
};

spl_autoload_register($autoload);

$app = new Application();
$app->execute();
