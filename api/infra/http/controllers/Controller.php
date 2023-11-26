<?php

namespace Infra\Http\Controllers;

use Core\Request;
use PDO;

class Controller extends Request
{
  protected array $body;

  public function __construct(private PDO $db)
  {
    parent::__construct();

    $this->body = $this->getBody();
  }
}
