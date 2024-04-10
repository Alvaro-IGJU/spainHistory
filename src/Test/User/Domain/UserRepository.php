<?php

namespace App\Test\User\Domain;

interface UserRepository
{

    public function addUser(User $user):bool;

    public function updateUser(User $user):bool;


}