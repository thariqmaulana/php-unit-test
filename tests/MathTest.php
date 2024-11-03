<?php

namespace Thariq\Test;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase {
  /**Apa itu data provider?
   * ibaratnya ada 1 fn yg kita ingin test dengan berbagai macam model input
   * nah daripada memanggil berkali-kali
   * kita bisa
   */

   public function testManual()
   {
    // tidak direkomendasikan manual seperti ini
    // dianggap 1 kesatuan unit test
    // 1 gagal maka semua gagal. dan kita perlu cek mana yg gagal secara manual
    self::assertEquals(10, Math::sum([5,5]));
    self::assertEquals(20, Math::sum([5,5,5,5]));
    self::assertEquals(24, Math::sum([4,4,4,4,4,4]));
   }

   /**
    * @dataProvider mathSumData
    */
    public function testDataProvider(array $values, int $expected)
    {
      self::assertEquals($expected, Math::sum($values));
    }
    // harus static di versi terbaru phpunit untuk optimasi
    // dianggap 3 unit test
    public static function mathSumData(): array
    {
      return [
        [[5,5], 10],
        [[5,5,5,5], 20],
        [[4,4,4,4,4,4], 24],
        [[], 0],
      ];
    }

    /**Alternatif dataProvider 
     * cukup dimasukkan dalam komentar
     * hanya untuk kasus sederhana
    */

    /**
     * @testWith [[5,5], 10]
    *            [[5,5,5,5], 20]
     *           [[4,4,4,4,4,4], 24]
     */
    public function testWith(array $values, int $expected)
    {
      self::assertEquals($expected, Math::sum($values));
    }
    // test seperti ini juga dihitung per test. jadi ada 3. bukan satu kesatuan
}

/**
 * Bagaimana jika kita melakukan suatu test yang tidak return value apapun?
 * misalnya hanya melakukan echo saja?
 * php unit memiliki fitur yg bisa mendeteksi output
 * untuk mengecek bahwa output yg dihasilkan sesuai dengan yg kita inginkan
 */