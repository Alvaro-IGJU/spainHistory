<?php

namespace App\Test\User\Domain;

interface UserRepository
{

    public function addUser(User $user):bool;

    public function updateUser(array $user):bool;

    public  function getPaginatedData(int $page, int $itemsPerPage, string $filter, int $userId = null): array;

}