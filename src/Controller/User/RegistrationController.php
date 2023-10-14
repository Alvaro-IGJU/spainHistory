<?php

namespace App\Controller\User;

use App\Test\User\Application\Registration\RegistrationCommandHandler;
use App\Test\User\Domain\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController
{
    /**
     * @var RegistrationCommandHandler$registrationHandler
     */
    private $registrationHandler;

    /**
     * @param RegistrationCommandHandler $registrationHandler
     */
    public function __construct(RegistrationCommandHandler $registrationHandler)
    {
        $this->registrationHandler = $registrationHandler;
    }


    public function __invoke(Request $request):Response
    {
        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response= $this->registrationHandler->handler($data);

        return new JsonResponse($response->isResponse());
    }


}