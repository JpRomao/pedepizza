<?php

namespace Application\Entities;

use Core\Entities\Entity;
use Core\Entities\UniqueEntityId;

class Pizza extends Entity
{
  public function getName(): string
  {
    return $this->props['name'];
  }

  public function getImage(): string
  {
    return $this->props['image'];
  }

  public function getIngredients(): array
  {
    return $this->props['ingredients'];
  }

  public function getCreatedBy(): int
  {
    return $this->props['created_by'];
  }

  public function setName(string $name)
  {
    $this->props['name'] = $name;
  }

  public function setImage(string $image)
  {
    $this->props['image'] = $image;
  }

  public function setCreatedBy(int $createdBy)
  {
    $this->props['created_by'] = $createdBy;
  }

  public function setIngredients(array $ingredients)
  {
    $ingredients = $this->mapIngredients($ingredients);

    $this->props['ingredients'] = $ingredients;
  }

  private function mapIngredients(array $ingredients)
  {
    return array_map(function ($ingredient) {
      return Ingredient::create(array(
        'name' => $ingredient['name'],
        'image' => $ingredient['image']
      ), new UniqueEntityId($ingredient['id']));
    }, $ingredients);
  }


  public static function create(array $props, ?UniqueEntityId $id)
  {
    $props['ingredients'] = array_map(function ($ingredient) {
      return Ingredient::create(array(
        'name' => $ingredient['name'],
        'image' => $ingredient['image']
      ), new UniqueEntityId($ingredient['id']));
    }, $props['ingredients']);

    return new Pizza($props, $id);
  }

  public function toArray(): array
  {
    $array = parent::toArray();

    $array['ingredients'] = array_map(function ($ingredient) {
      return $ingredient->toArray();
    }, $array['ingredients']);

    return $array;
  }
}
