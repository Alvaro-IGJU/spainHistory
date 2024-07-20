<?php

namespace App\Controller\Category;

use App\Test\Category\Application\ListCategory\CategoryCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{
    private CategoryCommandHandler $handler;

    /**
     * @param CategoryCommandHandler $handler
     */
    public function __construct(CategoryCommandHandler $handler)
    {
        $this->handler = $handler;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = $request->query->getInt('itemsPerPage', 10);
        $filter = $request->query->getString('filter', '');
        $response = $this->handler->handler(['page'=>$page, 'itemsPerPage'=>$itemsPerPage,'filter'=>$filter]);
        return new JsonResponse(['listCategories' => $response->getCategories()]);
    }


}
