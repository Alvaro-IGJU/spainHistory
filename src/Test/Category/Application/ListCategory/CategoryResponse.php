<?php

namespace App\Test\Category\Application\ListCategory;

class CategoryResponse
{

    /**
     * @var array $category
     */
    private $category;

    /**
     * @param array $category
     */
    public function __construct(array $category)
    {
        $this->category = $category;
    }

    public function getCategories(): array
    {
        return $this->category;
    }

}
