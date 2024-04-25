<?php

namespace App\Test\Product\Application\StoreProduct;



use App\Test\Product\Infrastructure\ProductRepository;
use Exception;

class ProductStoreCommandHandler
{
    /**
     * @var ProductRepository $productRepository
     */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function handler($data): ProductStoreResponse{
        try {
            if(is_null($data['id'])){
                $resultResponse = $this->productRepository->storeProduct($data);
            }else{
                $resultResponse = $this->productRepository->updateProduct($data);
            }
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new ProductStoreResponse($resultResponse);
    }

}
