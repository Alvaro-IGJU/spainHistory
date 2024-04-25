<?php

namespace App\Controller;

use App\Test\User\Domain\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(#[CurrentUser] User $user = null,AuthenticationUtils $authenticationUtils): JsonResponse
    {
        $error = $authenticationUtils->getLastAuthenticationError();

                 $lastUsername = $authenticationUtils->getLastUsername();
        $sessionToken = bin2hex(random_bytes(32));
        return new JsonResponse([
            'session_token' => $user?$sessionToken:'no existe el usuario',
            'last_username' => $lastUsername,
            'user'=>$user->getEmail(),
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout():JsonResponse
    {
        return new JsonResponse(['exit'=>'success']);
    }
}
