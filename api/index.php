<?php

use Infra\Database\Mysql;

define('BASE_URL', 'http://localhost/pedepizza');
define('DB_HOST', 'localhost');
define('DB_NAME', 'pedepizza');
define('DB_USER', 'root');
define('DB_PASS', '');

$autoload = function (string $class) {
  include_once './utils.inc.php';

  $archiveName = makePathByClass($class);

  if (file_exists($class . '.php')) {
    include_once $class . '.php';
  } else if (file_exists($archiveName . '.php')) {
    include_once $archiveName . '.php';
  } else {
    die("Class $class not found");
  }
};

spl_autoload_register($autoload);

$mysql = new Mysql(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$app = new App($mysql->getInstance());
$app->run();
