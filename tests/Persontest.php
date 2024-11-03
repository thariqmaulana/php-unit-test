<?php

namespace Thariq\Test;

use Exception;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

  private Person $person;
  /**
   * cara kerja: setup-test success
   * setup-next test
   * jadi bukan sekali di awal
   * setiap test dibuat baru lagi
   */

   /** Cara lain membuat setUp
    * dengan anotasi @before
    * dan jadinya bisa membuat lebih dari 1 setup
    */

    /**
     * @before
     */
  public function createPerson()
  {
    $this->person = new Person("Thariq");
  }
  //tidak ada urutan pasti. setup dulu atau before dulu
  protected function setUp(): void
  {
    $this->person = new Person("Thariq");
  }

  /**setelah dieksekusi unit testnya
   * alternatif @after
  */ 
  protected function tearDown(): void
  {
    echo "After" . PHP_EOL;
  }

  public function testSuccess()
  {
    // $person = new Person("Thariq");
    // self::assertEquals("Hello Said, my name is Thariq", $person->sayHello("Said"));
    self::assertEquals("Hello Said, my name is Thariq", $this->person->sayHello("Said"));
  }

  public function testFailed()
  {
    // $person = new Person("Thariq");
    self::expectException(Exception::class);
    $this->person->sayHello(null);
    // $person->sayHello(null);
    // tidak muncul autocomplete dengan self tapi ada harusnya.
    // jadi gunakan this saja selanjutnya
  }

  public function testSayGoodBye()
  {
    // $person = new Person("Thariq");
    $this->expectOutputString("Good Bye Said" . PHP_EOL);
    $this->person->sayGoodBye("Said");
  }
}