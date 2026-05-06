<?php

namespace App\Application\Tenant\Service;

use App\Application\User\Port\MailerPort;
use App\Domain\Tenant\Service\ActivationGenerator;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\User\Entity\User;

class WelcomeTenantService
{
    public function  __construct(private MailerPort $mailerPort , private ActivationGenerator $tokenGenerator)
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
}
