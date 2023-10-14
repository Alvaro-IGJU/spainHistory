<?php

namespace App\Test\User\Application\Registration;

use App\Test\User\Domain\User;
use App\Test\User\Infrastructure\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationCommandHandler
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;


    /**
     * @var UserPasswordHasherInterface $passwordHasher
     */
    private $passwordHasher;

    /**
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }


    public function handler(array $data):RegistrationResponse
    {
        $user = new User();
        $plaintextPassword =$data['pass'] ;
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setEmail($data['email']);

        $response = $this->userRepository->addUser($user);

        return new RegistrationResponse($response);

    }


}