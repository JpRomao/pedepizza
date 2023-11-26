<?php

namespace Infra\Http\Controllers;

use Application\UseCases\FetchPizzasByIngredientsUseCase;
use Core\Response;
use Exception;
use Infra\Database\Errors\ConnectionError;
use Infra\Database\Repositories\MysqlPizzaIngredientsRepository;
use PDO;
use PDOException;

class FetchPizzasByIngredientsController extends Controller
{
  public function __construct(private PDO $db)
  {
    parent::__construct($db);
  }

  public function handle()
  {
    try {
      $pizzasIngredientsRepository = new MysqlPizzaIngredientsRepository($this->db);

      $fetchPizzasByIngredientsUseCase = new FetchPizzasByIngredientsUseCase($pizzasIngredientsRepository);

      $ingredients = $_GET['ingredients'] ?? [];

      $pizzas = $fetchPizzasByIngredientsUseCase->execute($ingredients);

      return new Response(200, $pizzas);
    } catch (Exception | ConnectionError | PDOException $e) {
      if ($e instanceof ConnectionError) {
        return new Response($e->getErrorCode(), $e->_getMessage());
      }

      return new Response(500, ['error' => $e->getMessage()]);
    }
  }
}
