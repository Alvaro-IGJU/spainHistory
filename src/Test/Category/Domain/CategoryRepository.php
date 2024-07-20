<?php

namespace App\Test\Category\Domain;

use App\Test\Article\Application\DeleteArticle\ArticleDeleteResponse;
use App\Test\Article\Application\ListArticle\ArticleResponse;
use App\Test\Category\Application\ListCategory\CategoryResponse;

interface CategoryRepository
{

    public function getCategory(array $criteria):CategoryResponse;
    public  function getPaginatedData(int $page, int $itemsPerPage, string $filter): array;

    public function storeCategory(array $category): bool;


}
