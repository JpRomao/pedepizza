<?php
$autoload = function ($class) {
  if (file_exists($class . '.php')) {
    include_once $class . '.php';
  } else {
    include_once 'pages/404.php';
    die();
  }
};

spl_autoload_register($autoload);

$app = new Application();
$app->execute();
