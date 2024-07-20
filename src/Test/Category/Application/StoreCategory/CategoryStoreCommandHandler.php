<?php

namespace App\Test\Category\Application\StoreCategory;

use App\Test\Category\Application\StoreCategory\CategoryStoreResponse;
use App\Test\Category\Domain\Category;
use App\Test\Category\Infrastructure\CategoryRepository;
use Exception;

class CategoryStoreCommandHandler
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
    public function handler($data): CategoryStoreResponse
    {
        try {
            if(is_null($data['id'])){

                $resultResponse = $this->categoryRepository->storeCategory($data);
            }else{
                $resultResponse = $this->categoryRepository->updateCategory($data);
            }
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new CategoryStoreResponse($resultResponse);
    }
}
