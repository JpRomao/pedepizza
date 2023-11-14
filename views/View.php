<?php

namespace Views;

class View
{
  const DEFAULT_HEAD = 'head.php';
  const DEFAULT_HEADER = 'header.php';
  const DEFAULT_FOOTER = 'footer.php';

  private $fileName;

  public function __construct($fileName = 'home')
  {
    $this->fileName = $fileName;
  }

  public function render(
    $data = [
      'title' => 'PedePizza',
      'styles' => [],
      'description' => 'PedePizza é uma pizzaria online que entrega pizzas deliciosas e quentinhas na sua casa.',
      'scripts' => [],
    ]
  ) {
    include_once 'views/templates/' . self::DEFAULT_HEAD;
    include_once 'views/templates/' . self::DEFAULT_HEADER;
    include_once 'views/pages/' . $this->fileName . '.php';
    include_once 'views/templates/' . self::DEFAULT_FOOTER;
  }

  public function renderWithoutLayout($fileName)
  {
    include_once 'views/pages/' . $fileName . '.php';
  }
}
