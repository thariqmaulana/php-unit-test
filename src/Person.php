<?php

/**
 * Unit test yg baik membuat skenario yg berhasil maupun gagal
 */

namespace Thariq\Test;

use Exception;

class Person {

  public function __construct(private string $name) {
  }

  public function sayHello(?string $name) 
  {
    if ($name == null) throw new Exception("Name is null");
    return "Hello $name, my name is $this->name";
  }

  public function sayGoodBye(?string $name): void
  {
    echo "Good Bye $name" . PHP_EOL;
  }
}