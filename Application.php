<?php
define('FULL_PATH', 'http://localhost/pedepizza');

class Application
{
  public function execute()
  {
    $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'home';

    if (!file_exists('pages/' . $url . '.php')) {
      $url = '404';
    }

    $this->render($url);
  }

  private function render($url)
  {
    $data = [];

    $isPageFound = $url !== '404';

    if ($isPageFound) {
      $data['title'] = 'PedePizza';
      $data['description'] = 'PedePizza é um sistema online que permite que você monte sua pizza do jeito que quiser.';

      include_once 'pages/templates/head.php';
      include_once 'pages/templates/header.php';
    } else {
      $data['title'] = 'Página não encontrada';
      $data['description'] = 'A página que você está tentando acessar não existe.';
    }

    include_once 'pages/' . $url . '.php';

    if ($isPageFound) {
      include_once 'pages/templates/footer.php';
    }
  }
}
