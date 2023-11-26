<?php

namespace Application\UseCases\Errors;

use Exception;

class ResourceNotFoundError extends Exception
{
  private string $_message;

  public function __construct(string $resource)
  {
    if ($resource) {
      $this->_message = "$resource not found.";
    } else {
      $this->_message = "Resource not found.";
    }

    parent::__construct($this->_message);
  }
}
