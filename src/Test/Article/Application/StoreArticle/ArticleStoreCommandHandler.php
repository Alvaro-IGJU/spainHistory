<?php

namespace App\Test\Article\Application\StoreArticle;

use App\Test\Article\Application\StoreArticle\ArticleStoreResponse;
use App\Test\Article\Domain\Article;
use App\Test\Article\Infrastructure\ArticleRepository;
use App\Test\User\Domain\UserRepository;
use Exception;

class ArticleStoreCommandHandler
{
    /**
     * @var ArticleRepository $articleRepository
     */
    private $articleRepository;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @param ArticleRepository $articleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ArticleRepository $articleRepository, UserRepository $userRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
    }

    public function handler($data): ArticleStoreResponse
    {
        try {
            if (is_null($data['id'])) {
                $resultResponse = $this->articleRepository->storeArticle($data, $this->userRepository);

                if (!$resultResponse) {
                    return new ArticleStoreResponse("No ha podido guardar el articulo");
                }
            } else {
                $resultResponse = $this->articleRepository->updateArticle($data);
                if (!$resultResponse) {
                    return new ArticleStoreResponse("No ha podido actualizar el articulo");
                }
            }
        } catch (\Exception $exception) {
            return new ArticleStoreResponse("Error: " . $exception->getMessage());
        }

        return new ArticleStoreResponse("Ha guardado el articulo");
    }
}
