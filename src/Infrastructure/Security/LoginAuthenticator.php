<?php

namespace App\Infrastructure\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public function __construct(
        private readonly RouterInterface $router
    ) {}

    public function authenticate(Request $request): Passport
    {
        $email    = $request->request->get('_username', '');
        $password = $request->request->get('_password', '');
        $csrf     = $request->request->get('_csrf_token', '');

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('authenticate', $csrf),
                new RememberMeBadge(),
            ]
        );
    }
     public function onAuthenticationSuccess(Request $request, $token, string $firewallName): Response
{
    if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
        return new RedirectResponse($targetPath);
    }

    $user = $token->getUser();

    if (in_array('ROLE_ADMIN', $user->getRoles())) {
        return new RedirectResponse($this->router->generate('app_admin_dashboard'));
    }
    return new RedirectResponse($this->router->generate('app_user_dashboard'));
}

    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate('app_login');
    }

}