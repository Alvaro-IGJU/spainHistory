<?php

namespace App\Test\Category\Application\ListCategory;

use App\Test\Category\Application\ListCategory\CategoryResponse;
use App\Test\Category\Domain\Category;
use App\Test\Category\Infrastructure\CategoryRepository;
use Exception;

class CategoryCommandHandler
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function handler(array $criteria): CategoryResponse
    {
        try {
            $categoryResponse = $this->categoryRepository->getPaginatedData($criteria['page'],$criteria['itemsPerPage'],$criteria['filter']);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new CategoryResponse($categoryResponse);
    }
}
