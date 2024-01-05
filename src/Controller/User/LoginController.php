<?php

namespace App\Controller\User;

use App\Test\User\Domain\User;
use App\Test\User\Domain\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;



class LoginController extends AbstractController
{


    /**
     * @throws JWTEncodeFailureException
     */
    #[Route('/login', name: 'api_login')]

     public function index(#[CurrentUser] ?User $user,Request $request,JWTEncoderInterface $jwtEncoder,UserRepository $userRepository): Response
{

             if (null === $user) {
                return $this->json([
                         'message' => 'missing credentials',
                   ], Response::HTTP_UNAUTHORIZED);
             }

    $token = $jwtEncoder->encode([
        'email' => $user->getUserIdentifier(),
        'exp' => time() + 3600, // 1 hour expiration
    ]);

             $user->setApiToken($token);



          return $this->json([
                           'message' => 'Welcome to your new controller!',
                           'path' => 'src/Controller/ApiLoginController.php',
                           'user'  => $user,
                           'token' => $token,
          ]);
      }



}