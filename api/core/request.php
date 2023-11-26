<?php

namespace Core;

class Request
{
  protected $request = [];

  public function __construct()
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    $allowedMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    if (!isset($_SERVER['REQUEST_METHOD']) || !in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
      return new Response(405, 'Method not allowed');
    }

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $body = json_decode(file_get_contents('php://input'), true);

    if ($method === 'POST' && empty($body)) {
      $body = $_POST;
    }

    if ($method === 'PUT' && empty($body)) {
      $body = $_POST;
    }

    if ($method === 'DELETE' && empty($body)) {
      $body = $_POST;
    }

    $this->request = [
      'method' => $method,
      'uri' => $uri,
      'body' => $body ?? [],
      'headers' => getallheaders(),
      'query' => $_GET ?? null,
    ];
  }

  public function getMethod()
  {
    return $this->request['method'];
  }

  public function getUri()
  {
    return $this->request['uri'];
  }

  public function getBody()
  {
    return $this->request['body'];
  }

  public function getHeaders()
  {
    return $this->request['headers'];
  }
}
