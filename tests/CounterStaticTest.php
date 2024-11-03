<?php

/**
*membuat object Person test
*setup
*unit test
*tear down
*repeat untuk test lain.
*jadi tiap test beda object persontest
*
*lantas bagaimana jika koneksi ke db? akan merepotkan jika bolak balik konek
*caranya adalah dengan dijadikan static. jadi dia menempel di class bukan objnya
*Sharing Fixture namanya
 */

namespace Thariq\Test;

use PHPUnit\Framework\TestCase;

class CounterStaticTest extends TestCase
{
  public static Counter $counter;
  /**
   * setUpBeforeClass() / @beforeClass
   *tearDownClass() / @afterClass
   *Hanya dipanggil sekali saja
   */

   public static function setUpBeforeClass(): void
   {
    self::$counter = new Counter();
   }

   public function testFirst()
   {
    self::$counter->increment();
    self::assertEquals(1, self::$counter->getCounter());
   }

   public function testSecond()
   {
    self::$counter->increment();
    self::assertEquals(2, self::$counter->getCounter());
   }

   public static function tearDownAfterClass(): void
   {
    echo "Test Selesai" . PHP_EOL;
   }
}
/**Incomplete Test
 * 
 */