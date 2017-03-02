<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\EventListener;



use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;    
/**
 * Description of AuthenticationEventListener
 *
 * @author jvillalv
 */
class AuthenticationEventListener implements AuthenticationSuccessHandlerInterface
{    
    protected $router;
    protected $security;
    protected $container;

    public function __construct(Router $router, TokenStorageInterface $security, $container)
    {
        $this->router = $router;
        $this->security = $security;
        $this->container = $container;        
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $em = $this->container->get('doctrine')->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $user->setLastLoginAt();
        $em->persist($user);
        $em->flush();
        return new RedirectResponse($this->router->generate('home'));
    }

}