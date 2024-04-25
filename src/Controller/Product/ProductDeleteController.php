<?php

namespace App\Controller\Product;

use App\Test\Product\Application\DeleteProduct\ProductDeleteCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductDeleteController
{
    private ProductDeleteCommandHandler $productDeleteCommandHandler;


    public function __construct(ProductDeleteCommandHandler $productDeleteCommandHandler)
    {
        $this->productDeleteCommandHandler = $productDeleteCommandHandler;
    }


    public function __invoke(Request $request): JsonResponse
    {

        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response = $this->productDeleteCommandHandler->handler($data['delete']);
        return new JsonResponse($response->isResponse());
    }

}
