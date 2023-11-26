<?php

namespace Application\UseCases\Errors;

use Exception;

class FieldsMissingError extends Exception
{
  private $errorCode = 500;

  public function __construct()
  {
    parent::__construct("Required Fields are missing.");
  }

  public static function _getMessage()
  {
    return "Required Fields are missing.";
  }

  public function getErrorCode()
  {
    return $this->errorCode;
  }
}
