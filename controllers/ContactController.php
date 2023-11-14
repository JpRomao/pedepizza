<?php

namespace Controllers;

class ContactController extends Controller
{
  public function __construct($view, $model)
  {
    parent::__construct($view, $model);
  }

  public function execute()
  {
    $this->view->render('PedePizza - Contato', ['contact']);
  }
}
