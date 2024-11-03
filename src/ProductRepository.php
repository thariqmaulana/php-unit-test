<?php

namespace Thariq\Test;

interface ProductRepository {
  // bikin impl di real world

  function save(Product $product): Product;
  // return stubnya stub product
  
  function delete(?Product $product): void;
  // tidak akan melakukan apa-apa kalau void

  function findById(string $id): ?Product;
  // null

  function findAll(): array;
  // arr kosong
  /**
   * ada caranya jika ingin variasi
   * dengan invocation stubber
   */

}