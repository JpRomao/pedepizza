<?php

namespace Application\UseCases\Errors;

use Exception;

class AlreadyExistsError extends Exception
{
  private $errorCode = 409;

  public function __construct()
  {
    parent::__construct("Already exists.");
  }

  public static function _getMessage()
  {
    return "Already exists.";
  }

  public function getErrorCode()
  {
    return $this->errorCode;
  }
}
