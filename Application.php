<?php
define('FULL_PATH', 'http://localhost/pedepizza');

class Application
{
  public function execute()
  {
    $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'Home';
    $url = ucfirst(strtolower($url));
    $url .= 'Controller';

    if (!file_exists('controllers/' . $url . '.php')) {
      die("Not found");
    }

    $url = 'Controllers\\' . $url;

    $controller = new $url();
    $controller->execute();
  }
}
