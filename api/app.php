<?php

use Infra\Http\Controllers\CreateIngredientController;
use Infra\Http\Controllers\CreatePizzaController;
use Infra\Http\Controllers\FetchIngredientsController;
use Infra\Http\Controllers\FetchPizzasByIngredientsController;
use Infra\Http\Controllers\FindPizzeriaByPizzaIdController;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

class App
{
  private $router;

  public function __construct(private PDO $db)
  {
  }

  public function run()
  {
    $this->router = new Router();

    $this->router->get('/ingredients', function () {
      $fetchIngredientsController = new FetchIngredientsController($this->db);

      return $fetchIngredientsController->handle()->json();
    });

    $this->router->post('/ingredients', function () {
      $createIngredientController = new CreateIngredientController($this->db);

      return $createIngredientController->handle()->json();
    });

    $this->router->get('/pizzas', function () {
      $fetchPizzasByIngredientsController = new FetchPizzasByIngredientsController($this->db);

      return $fetchPizzasByIngredientsController->handle()->json();
    });

    $this->router->post('/pizzas', function () {
      $createPizzaController = new CreatePizzaController($this->db);

      return $createPizzaController->handle()->json();
    });

    $this->router->get('/pizzerias', function () {
      $fetchPizzeriasController = new FindPizzeriaByPizzaIdController($this->db);

      return $fetchPizzeriasController->handle()->json();
    });

    $this->router->resolve();
  }
}
