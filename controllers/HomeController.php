<?php

namespace Controllers;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->view = new \Views\View('home');
  }
}
