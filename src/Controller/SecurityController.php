<?php

namespace App\Controller;

use App\Test\User\Domain\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?User $user, AuthenticationUtils $authenticationUtils): JsonResponse
    {
        if (null === $user) {
            return new JsonResponse(['message' => 'Invalid credentials'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Generar el token JWT
        $token = $this->jwtManager->create($user);

        return new JsonResponse([
            'token' => $token,
            'user_id' => $user->getId(),
            'user' => $user->getEmail(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): JsonResponse
    {
        // Symfony se encarga de la lógica de logout automáticamente
        return new JsonResponse(['message' => 'Logged out successfully']);
    }
}
