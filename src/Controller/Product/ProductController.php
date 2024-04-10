<?php

namespace App\Controller\Product;

use App\Test\Product\Application\ListProduct\ProductCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    private ProductCommandHandler $handler;

    /**
     * @param ProductCommandHandler $handler
     */
    public function __construct(ProductCommandHandler $handler)
    {
        $this->handler = $handler;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = $request->query->getInt('itemsPerPage', 10);
        $filter = $request->query->getString('filter', '');
        $response = $this->handler->handler(['page'=>$page, 'itemsPerPage'=>$itemsPerPage,'filter'=>$filter]);
        return new JsonResponse(['listProducts' => $response->getProducts()]);
    }


}
