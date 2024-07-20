<?php

namespace App\Controller\Article;

use App\Test\Article\Application\ListArticle\ArticleCommandHandler;
use App\Test\Article\Application\StoreArticle\ArticleStoreCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleStoreController
{
    private ArticleStoreCommandHandler $handler;

    /**
     * @param ArticleStoreCommandHandler $handler
     */
    public function __construct(ArticleStoreCommandHandler $handler)
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
                return new Response('Article guardado');
            }
        }catch (\Exception $exception) {
            return new Response('Error save article', 500);
        }
    }


}
