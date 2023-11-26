<?php

namespace Infra\Database\Errors;

use PDOException;

class ConnectionError extends PDOException
{
  private $errorCode = 500;

  public function __construct(private PDOException $e)
  {
    parent::__construct($this->e->getMessage());
  }

  public static function _getMessage()
  {
    return "Connection Error.";
  }

  public function getErrorCode()
  {
    return $this->errorCode;
  }

  public function getError()
  {
    return $this->e;
  }
}
