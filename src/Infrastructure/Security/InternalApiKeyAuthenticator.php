<?php

namespace App\Infrastructure\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class InternalApiKeyAuthenticator extends AbstractAuthenticator
{

    private string $internalSecret;
    public function __construct(string $internalSecret){
        $this->internalSecret = $internalSecret;
    }
    public function supports(Request $request): ?bool
    {
        return str_starts_with($request->getPathInfo(), '/api/internal');
    }

    public function authenticate(Request $request): Passport
    {
        $apiKey = $request->headers->get('X-Internal-Secret');
        if(empty($apiKey) || $apiKey != $this->internalSecret) {
            throw new AuthenticationException('Invalid Internal Secret Key');
        }

        return new SelfValidatingPassport(
            new UserBadge("KONG_IDENTIFIER",
            function ($identifier){
                return new MachineUser($identifier , ["ROLE_INTERNAL_MACHINE"]);
            }

        ));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null; //Continue :)
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(
            data:["error"=>"Machine identity authentication failed"],
            status:Response::HTTP_FORBIDDEN
        );
    }
}
