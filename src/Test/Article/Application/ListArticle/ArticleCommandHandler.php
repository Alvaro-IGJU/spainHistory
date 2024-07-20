<?php

namespace App\Test\Article\Application\ListArticle;

use App\Test\Article\Application\ListArticle\ArticleResponse;
use App\Test\Article\Domain\Article;
use App\Test\Article\Infrastructure\ArticleRepository;
use Exception;

class ArticleCommandHandler
{
    /**
     * @var ArticleRepository $articleRepository
     */
    private $articleRepository;

    /**
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    public function handler(array $criteria): ArticleResponse
    {
        try {
            $articleResponse = $this->articleRepository->getPaginatedData($criteria['page'],$criteria['itemsPerPage'],$criteria['filter']);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new ArticleResponse($articleResponse);
    }
}
