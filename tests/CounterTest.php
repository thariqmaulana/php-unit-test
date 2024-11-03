<?php

/**
 * How to run the test?
 * vendor/bin/phpunit folder/file.php
 */

 /**Menjalankan unit test per method
  * vendor/bin/phpunit --filter'ClassTest::testMethod' folder/file.php
  */

namespace Thariq\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

// ClassTest ini kebiasaan di dalam penamaan
class CounterTest extends TestCase {

  /**
   *  harus depannya test
   * atau diberi anotasi @test lalu bebas
   */
  public function testCounter()
  {
    /**
     * karena namespace src dengan test sama
     * maka tak perlu use
     * jadi aslinya seperti 1 kesatuan
     * tapi dipisah file
     */
    $counter = new Counter();

    $counter->increment();
    Assert::assertEquals(1, $counter->getCounter());
    
    /**TestCase extend assert */
    $counter->increment();
    $this->assertEquals(2, $counter->getCounter());

    $counter->increment();
    self::assertEquals(3, $counter->getCounter());
    
  }

  public function testOther()
  {
    echo "Other" . PHP_EOL;
  }

  /**
   * @test
   */
  public function increment()
  {
    $counter = new Counter();
    $counter->increment();
    self::assertEquals(1, $counter->getCounter());
  }

  /**
   * test dependency
   * test kedua depends/menggunakan data test pertama
   * Tapi unit test yg baik itu indenpenden. tidak bergantung dengan unit test lain
   */

  public function testFirst(): Counter
  {
    $counter = new Counter();
    $counter->increment();
    self::assertEquals(1, $counter->getCounter());

    return $counter;
  }
  // kalau testfirstnya sudah gagal maka test kedua akan langsung gagal/ tidak di exe

  /**
   * @depends testFirst
   */
  public function testSecond(Counter $counter)
  {
    // run testScnd saja maka testfirst akan ikut jalan. karena butuh datanya
    $counter->increment();
    self::assertEquals(2, $counter->getCounter());
  }

  /**Incomplete Test
  *akan ada laporan incomplete
   */
   public function testIncrement()
   {
    $counter = new Counter();
    self::assertEquals(0, $counter->getCounter());
    self::markTestIncomplete("TODO Increment");
    // kode dibawahnya tidak akan dieksekusi
    echo "Tidak dijalankan";
   }

   /** Skip Test
   * akan ada laporan skip
   */
  public function testIncrement2()
  {
    self::markTestSkipped("Masih belum selesai nich");
    // kode dibawahnya tidak akan dieksekus
    $counter = new Counter();
  }
  /** Skip Test
   * skip berdasarkan kondisi. misal versi php, os, ....
   * menggunakan requires
   */

  /**
   * @requires OSFAMILY Linux
   */
  public function testRequires()
  {
    echo "Ga Jalan di Windows";//skipped
  }

}

