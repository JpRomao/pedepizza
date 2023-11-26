<?php

namespace Infra\Http\Controllers;

use Core\Response;
use Infra\Database\Repositories\MysqlIngredientsRepository;
use Application\UseCases\FetchIngredientsUseCase;
use Exception;
use Infra\Database\Errors\ConnectionError;
use PDO;
use PDOException;

class FetchIngredientsController extends Controller
{
  public function __construct(private PDO $db)
  {
    parent::__construct($db);
  }

  public function handle()
  {
    try {
      $ingredientsRepository = new MysqlIngredientsRepository($this->db);

      $fetchIngredientsUseCase = new FetchIngredientsUseCase($ingredientsRepository);

      $ingredients = $fetchIngredientsUseCase->execute();

      return new Response(200, $ingredients);
    } catch (Exception | ConnectionError | PDOException $e) {
      if ($e instanceof ConnectionError) {
        return new Response($e->getErrorCode(), $e->_getMessage());
      }

      return new Response(500, ['error' => $e->getMessage()]);
    }
  }
}
