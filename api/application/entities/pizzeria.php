<?php

namespace Application\Entities;

use Core\Entities\Entity;
use Core\Entities\UniqueEntityId;

class Pizzeria extends Entity
{
  public function getName(): string
  {
    return $this->props['name'];
  }

  public function getCnpj(): string
  {
    return $this->props['cnpj'];
  }

  public function getPhone(): string
  {
    return $this->props['phone'];
  }

  public function getAddress(): array
  {
    $address = array(
      'street' => $this->props['street'],
      'number' => $this->props['number'],
      'neighborhood' => $this->props['neighborhood'],
      'city' => $this->props['city'],
      'state' => $this->props['state'],
      'zipCode' => $this->props['zip_code'],
    );

    return $address;
  }

  public function getCity(): string
  {
    return $this->props['city'];
  }

  public function getState(): string
  {
    return $this->props['state'];
  }

  public function getZipCode(): string
  {
    return $this->props['zip_code'];
  }

  public function getEmail(): string
  {
    return $this->props['email'];
  }

  public function getPassword(): string
  {
    return $this->props['password'];
  }

  public static function create(array $props, ?UniqueEntityId $id)
  {
    return new Pizzeria($props, $id);
  }
}
