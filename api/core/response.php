<?php

namespace Core;

class Response
{
  private $status = [];

  public function __construct(int $statusCode, $data = null, string $message = null)
  {
    http_response_code($statusCode);

    if ($message) {
      $this->status['message'] = $message;
    }

    if ($data) {
      $this->status['data'] = $data;
    }
  }

  public function json()
  {
    return json_encode($this->status);
  }

  public function getMessage(): string
  {
    return $this->status['message'];
  }
}
