<?php

namespace App\Application\Tenant\Service;

use App\Application\User\Port\MailerPort;
use App\Domain\Tenant\Exception\TokenInvalidException;
use App\Domain\Tenant\Repository\ActivationTokenRepositoryInterface;
use App\Domain\Tenant\Service\ActivationGenerator;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Domain\User\Entity\User;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

class WelcomeTenantService
{
    public function  __construct(private MailerPort $mailerPort , private ActivationGenerator $tokenGenerator , private ActivationTokenRepositoryInterface $repository)
    {

    }
    public function execute(User $ceo , string $subdomain):void{
        $tokenVO = $this->tokenGenerator->generateNewToken();
        //Sauvgarde of token todo ...

        $subdomain = new Subdomain($subdomain);
        $this->mailerPort->sendWelcomeActivation(
            $ceo,
            $tokenVO->getValue(),
            $subdomain->getValue(),
        );
    }

    public function checkToken(string $token):void{
        $valueObject = new TokenValue($token);
        $token = $this->repository->findByValue($valueObject);

        if (!$token) {
            throw new TokenNotFoundException("Provided token does not exist");
        }
        if ($token->isExpired() || $token->isUsed()) {
            throw new TokenInvalidException("This activation token is invalid");
        }

    }
}
