<?php

namespace App\Controller\Category;

use App\Test\Category\Application\ListCategory\CategoryCommandHandler;
use App\Test\Category\Application\StoreCategory\CategoryStoreCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryStoreController
{
    private CategoryStoreCommandHandler $handler;

    /**
     * @param CategoryStoreCommandHandler $handler
     */
    public function __construct(CategoryStoreCommandHandler $handler)
    {
        $this->handler = $handler;
    }
    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if(!isset($data["id"])){
            $data["id"] = null;
        }
        try{

            $response = $this->handler->handler($data);
            if ($response) {
                return new Response('Categoría guardada');
            }
        }catch (\Exception $exception) {
            return new Response($exception->getMessage(), 500);
            return new Response('Error save Category', 500);
        }
    }


}
