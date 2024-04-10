<?php

namespace App\Test\Product\Application\DeleteProduct;

use App\Test\Product\Infrastructure\ProductRepository;
use Exception;

class ProductDeleteCommandHandler
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
    public function handler($id):ProductDeleteResponse
    {
        try {

            $productResponse = $this->productRepository->deleteProduct($id);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new ProductDeleteResponse($productResponse->isResponse());

    }



}
