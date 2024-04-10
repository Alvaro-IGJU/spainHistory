<?php

namespace App\Controller\User;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController
{
    /**
     * @var AuthenticationUtils $authenticationUtils
     */
    private $authenticationUtils;

    /**
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

//    #[Route('/login', name: 'app_login')]
//    public function login(Request $request):Response
//    {
//        $items = ($request->getContent());
//        $data = json_decode($items, true);
//
//        $user=$this->authenticationUtils->getLastUsername();
//
//
//        // get the login error if there is one
//                 $error = $this->authenticationUtils->getLastAuthenticationError();
//
//                // last username entered by the user
//                $lastUsername = $this->authenticationUtils->getLastUsername();
////        $items = ($request->getContent());
////        $data = json_decode($items, true);
////        $response= $this->registrationHandler->handler($data);
//
//        return new JsonResponse($data);
//    }


}
