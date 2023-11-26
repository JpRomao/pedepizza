<?php

namespace Infra\Http\Controllers;

use PDO;
use Exception;
use Application\UseCases\CreatePizzaUseCase;
use Application\UseCases\Errors\FieldsMissingError;
use Core\Response;
use Infra\Database\Repositories\MysqlPizzasRepository;
use Infra\Database\Repositories\MysqlPizzaIngredientsRepository;

class CreatePizzaController extends Controller
{
  public function __construct(private PDO $db)
  {
    parent::__construct($db);
  }

  public function handle()
  {
    $name = $this->body['name'] ?? null;
    $image = $this->body['image'] ?? null;
    $createdBy = $this->body['createdBy'] ?? null;
    $ingredients = $this->body['ingredients'] ?? null;

    if (
      empty($name)
      || !is_string($name)
      || empty($image)
      || !is_string($image)
      || empty($createdBy)
      || !is_string($createdBy)
      || empty($ingredients)
      || !is_array($ingredients)
    ) {
      return new Response(500, null, FieldsMissingError::_getMessage());
    }

    $pizzaRepository = new MysqlPizzasRepository($this->db);
    $pizzasIngredientsRepository = new MysqlPizzaIngredientsRepository($this->db);
    $pizzaUseCase = new CreatePizzaUseCase($pizzaRepository, $pizzasIngredientsRepository);

    try {
      $pizzaUseCase->execute($name, $image, $createdBy, $ingredients);

      return new Response(201, null, 'Created successfully');
    } catch (Exception | FieldsMissingError $e) {
      if ($e instanceof FieldsMissingError) {
        return new Response($e->getErrorCode(), null, $e::_getMessage());
      }

      return new Response(500, null, 'Could not connect');
    }
  }
}
