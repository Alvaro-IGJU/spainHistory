<?php

namespace App\Controller\Product;

use App\Test\Product\Application\StoreProduct\ProductStoreCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductStoreController
{
    private ProductStoreCommandHandler $handler;

    public function __construct(ProductStoreCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {

        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response = $this->handler->handler($data);
        return new JsonResponse($response->isResponse());
    }

}
