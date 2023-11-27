<?php

namespace Infra\Http\Controllers;

use PDO;
use Exception;
use Application\UseCases\CreateIngredientUseCase;
use Application\UseCases\Errors\AlreadyExistsError;
use Application\UseCases\Errors\FieldsMissingError;
use Core\Response;
use Infra\Database\Repositories\MysqlIngredientsRepository;

class CreateIngredientController extends Controller
{
  public function __construct(private PDO $db)
  {
    parent::__construct($db);
  }

  public function handle()
  {
    $name = $this->body['name'] ?? null;
    $image = $this->body['image'] ?? null;

    if (empty($name) || !is_string($name) || empty($image) || !is_string($image)) {
      return new Response(500, null, FieldsMissingError::_getMessage());
    }

    $ingredientRepository = new MysqlIngredientsRepository($this->db);
    $ingredientUseCase = new CreateIngredientUseCase($ingredientRepository);

    try {
      $ingredientUseCase->execute($name, $image);

      return new Response(201, null, 'Created successfully');
    } catch (Exception | FieldsMissingError $e) {
      if ($e instanceof FieldsMissingError) {
        return new Response($e->getErrorCode(), null, $e::_getMessage());
      }

      if ($e instanceof AlreadyExistsError) {
        return new Response($e->getErrorCode(), null, $e::_getMessage());
      }

      return new Response(500, null, 'Could not connect');
    }
  }
}
