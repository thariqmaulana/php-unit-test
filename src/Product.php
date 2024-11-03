<?php

namespace Thariq\Test;

class Product {

  private string $id, $name, $description;
  private int $price, $quantity;

  public function getId():string {
    return $this->id;
  }

  public function setId($id):void {
    $this->id = $id;
  }

  public function getName():string {
    return $this->name;
  }

  public function setName($name):void {
    $this->name = $name;
  }

  public function getDescription():string {
    return $this->description;
  }

  public function setDescription($description):void {
    $this->$description = $description;
  }

  public function getPrice():int {
    return $this->price;
  }

  public function setPrice($price):void {
    $this->$price = $price;
  }

  public function getQuantity():int {
    return $this->quantity;
  }

  public function setQuantity($quantity):void {
    $this->$quantity = $quantity;
  }
}