<?php

namespace Infra\Database;

use Infra\Database\Errors\ConnectionError;
use PDO;

class Mysql
{
  private $instance = null;

  public function __construct(private string $host, private string $user, private string $pass, private string $name)
  {
    $dsn = 'mysql:host=' .  $this->host . ';dbname=' . $this->name . ';charset=utf8';
    $options = [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
      $this->instance = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (ConnectionError $e) {
      throw new ConnectionError($e);
    }
  }

  public function getInstance()
  {
    return $this->instance;
  }
}
