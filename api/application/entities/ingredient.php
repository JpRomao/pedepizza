<?php

namespace Application\Entities;

use Core\Entities\Entity;
use Core\Entities\UniqueEntityId;

class Ingredient extends Entity
{
  public function getName(): string
  {
    return $this->props['name'];
  }

  public function setName(string $name)
  {
    $this->props['name'] = $name;
  }

  public function getImage(): string
  {
    return $this->props['image'];
  }

  public function setImage(string $image)
  {
    $this->props['image'] = $image;
  }

  public static function create(array $props, ?UniqueEntityId $id)
  {
    return new Ingredient($props, $id);
  }
}
