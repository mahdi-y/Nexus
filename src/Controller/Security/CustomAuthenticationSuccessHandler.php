<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    use TargetPathTrait;

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoleNames();

        // Check if the user has the ROLE_ADMIN role
        if (in_array('ROLE_ADMIN', $roles, true)) {
            // Redirect the user to /admin
            return new RedirectResponse($this->router->generate('admin'));
        }

        // Redirect the user to /homepage
        return new RedirectResponse($this->router->generate('homepage'));
    }
}
