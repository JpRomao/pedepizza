<?php

namespace Core\Entities;

class Entity
{
  private $id;
  protected $props;

  protected function __construct(array $props = [], ?UniqueEntityId $id)
  {
    $this->id = $id ?? uniqid();
    $this->props = $props;
  }

  public function getId()
  {
    return $this->id;
  }

  public function equals(Entity $entity)
  {
    if ($entity === $this) {
      return true;
    }

    if ($entity->id === $this->id) {
      return true;
    }

    return false;
  }

  public function toArray(): array
  {
    $array = array();

    $array['id'] = $this->id->toString();

    foreach ($this->props as $key => $value) {
      $array[$key] = $value;
    }

    return $array;
  }
}
