<?php

namespace App\Controller\Article;

use App\Test\Article\Application\ListArticle\ArticleCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    private ArticleCommandHandler $handler;

    /**
     * @param ArticleCommandHandler $handler
     */
    public function __construct(ArticleCommandHandler $handler)
    {
        $this->handler = $handler;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = $request->query->getInt('itemsPerPage', 10);
        $filter = $request->query->getString('filter', '');
        $user = $request->query->getInt('user', 0);
        $response = $this->handler->handler(['page'=>$page, 'itemsPerPage'=>$itemsPerPage,'filter'=>$filter,'user'=>$user]);
        return new JsonResponse(['listArticles' => $response->getArticles()]);
    }


}
