<?php

namespace App\Test\Product\Application\ListProduct;

use App\Test\Product\Application\StoreProduct\ProductStoreResponse;
use App\Test\Product\Domain\Product;
use App\Test\Product\Infrastructure\ProductRepository;
use Exception;

class ProductCommandHandler
{
    /**
     * @var ProductRepository $productRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function handler(array $criteria): ProductResponse
    {
        try {
            $productResponse = $this->productRepository->getPaginatedData($criteria['page'],$criteria['itemsPerPage'],$criteria['filter']);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new ProductResponse($productResponse);
    }
}
