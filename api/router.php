<?php
class Router
{
  private $routes = [];

  public function get($path, $callback)
  {
    $this->routes['GET'][$path] = $callback;
  }

  public function post($path, $callback)
  {
    $this->routes['POST'][$path] = $callback;
  }

  public function put($path, $callback)
  {
    $this->routes['PUT'][$path] = $callback;
  }

  public function delete($path, $callback)
  {
    $this->routes['DELETE'][$path] = $callback;
  }

  public function resolve()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['PATH_INFO'] ?? '/';

    $query = $_GET;

    if ($query) {
      $path = str_replace('?' . $_SERVER['QUERY_STRING'], '', $path);
    }

    $callback = $this->routes[$method][$path] ?? false;

    if (!$callback) {
      http_response_code(404);

      return;
    }

    echo call_user_func($callback);
  }

  public function addRoutes($routes)
  {
    $this->routes = array_merge($this->routes, $routes);
  }

  public function exportRoutes()
  {
    return $this->routes;
  }
}
