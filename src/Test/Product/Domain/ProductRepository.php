<?php

namespace App\Test\Product\Domain;

use App\Test\Product\Application\DeleteProduct\ProductDeleteResponse;
use App\Test\Product\Application\ListProduct\ProductResponse;

interface ProductRepository
{

    public function getByProduct(array $criteria):ProductResponse;
    public function storeProduct(array $product):bool;
    public function updateProduct(array $product):bool;
    public function  deleteProduct(int $id):ProductDeleteResponse;



}
