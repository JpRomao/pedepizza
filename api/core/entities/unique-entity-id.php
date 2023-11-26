<?php

namespace Core\Entities;

class UniqueEntityId
{
  private string $value;

  public function toString()
  {
    return $this->value;
  }

  public function toValue()
  {
    return $this->value;
  }

  public function __construct(string $value = null)
  {
    $this->value = $value ?? uniqid();
  }

  public function equals(UniqueEntityId $id)
  {
    return $this->value === $id->value;
  }
}
