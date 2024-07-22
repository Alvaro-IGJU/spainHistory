<?php

namespace App\Test\Article\Domain;

use App\Test\Article\Application\DeleteArticle\ArticleDeleteResponse;
use App\Test\Article\Application\ListArticle\ArticleResponse;
use App\Test\User\Domain\UserRepository;

interface ArticleRepository
{

    public function getByArticle(array $criteria):ArticleResponse;
    public  function getPaginatedData(int $page, int $itemsPerPage, string $filter, int $userId = null): array;

    public function storeArticle(array $article, UserRepository $userRepository): bool;


}
