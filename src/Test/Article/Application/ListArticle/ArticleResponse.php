<?php

namespace App\Test\Article\Application\ListArticle;

class ArticleResponse
{

    /**
     * @var array $article
     */
    private $article;

    /**
     * @param array $article
     */
    public function __construct(array $article)
    {
        $this->article = $article;
    }

    public function getArticles(): array
    {
        return $this->article;
    }

}
