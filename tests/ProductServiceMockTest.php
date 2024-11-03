<?php

namespace Thariq\Test;

use Exception;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\equalTo;

class ProductServiceMockTest extends TestCase {

  private ProductRepository $productRepository;
  private ProductService $productService;

  protected function setUp(): void
  {
    // return default value
    $this->productRepository = $this->createMock(ProductRepository::class);
    $this->productService = new ProductService($this->productRepository);
  }

  /**Variasi invocation stubber */
  public function testStub()
  { 
    // bikin dulu product. karena returnnya itu harus product nanti
    $product = new Product();
    $product->setId("1");

    $this->productRepository->method("findById")
      ->willReturn($product);


    $result = $this->productRepository->findById("1");// walau 2 pun hasilnya tetap product "1"
    // $this->productRepository->findById()
    // var_dump($result);
    self::assertSame($product, $result);
  }

  public function testStubMap()
  {
    $product1 = new Product();
    $product1->setId("1");

    $product2 = new Product();
    $product2->setId("99");//penanda saja supaya pasti bener testnya

    /**Param pertama untuk findById. param terakhir returnya. 
     * bisa lebih dari 1 param untuk searchingnya
     */
    $map = [
      ["1", $product1],
      ["2", $product2],
    ];

    $this->productRepository->method("findById")
      ->willReturnMap($map);

    self::assertSame($product1, $this->productRepository->findById("1"));
    self::assertSame($product2, $this->productRepository->findById("2"));
  }

  public function testStubCallback()
  {
    $this->productRepository->method("findById")//paramnya sesuaikan aslinya
      ->willReturnCallback(function (string $id) {
        $product = new Product();
        $product->setId($id);
        return $product;
      });
    
      self::assertSame("1", $this->productRepository->findById("1")->getId());
      self::assertSame("99", $this->productRepository->findById("99")->getId());
  }

  public function testRegisterSuccess()
  {
    $this->productRepository->method("findById")
      ->willReturn(null);
    $this->productRepository->method("save")
      ->willReturnArgument(0);//argumen ke 0. karena cuma 1. return yg dikirim karena product itu sendiri

    $product = new Product();
    $product->setId("1");
    $product->setName("Laptop");

    $result = $this->productService->register($product);

    self::assertEquals($product->getId(), $result->getId());
    self::assertEquals($product->getName(), $result->getName());
  }

  public function testRegisterFailed()
  {
    $this->expectException(\Exception::class);

    $productInDB = new Product();
    $productInDB->setId("1");// tidak perlu juga sebenarnya. karena tidak di compare
    
    $this->productRepository->method("findById")
      ->willReturn($productInDB);

      $product = new Product();
      $product->setId("1");

      $this->productService->register($product);
  }

  public function testDelete()
  {
    $product = new Product();
    $product->setId("1");

    $this->productRepository->method("findById")
      ->willReturn($product);
    
      $this->productService->delete("1");
      self::assertTrue(true, "Success delete");
  }

  public function testDeleteFailed()
  {

    $this->expectException(\Exception::class);

    $this->productRepository->method("findById")
      ->willReturn(null);

    $this->productService->delete("1");
  }

  public function testMock() 
  {
    $product = new Product();
    $product->setId("1");

    $this->productRepository->expects(self::once())//self disini testcase
      ->method("findById")
      ->willReturn($product);

      $result = $this->productRepository->findById("1");
      // $result = $this->productRepository->findById("1");// error kalau 2 kali dipanggil
      self::assertSame($product, $result);
  }

  public function testDeleteMock()
  {
    $product = new Product();
    $product->setId("1");

    $this->productRepository->expects(self::once())
      ->method("delete")
      ->with($this->equalTo($product));

    $this->productRepository->expects(self::once())
      ->method("findById")
      ->willReturn($product)//dahulukan with sebaiknya
      ->with(equalTo("1"));//usekan biar gampang. tapi menggunakan this/self lebih disarankan 
      //karena menyiratkan menggunakan method assert
      
    
      $this->productService->delete("1");
      self::assertTrue(true, "Success delete");
  }

  public function testDeleteFailedMock()
  {

    $this->expectException(\Exception::class);

    $this->productRepository->expects(self::once())
      ->method("findById")
      ->willReturn(null);

    $this->productRepository->expects(self::never())
      ->method("delete");

    $this->productService->delete("1");
  }
}