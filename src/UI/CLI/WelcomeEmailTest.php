<?php

namespace App\UI\CLI;

use App\Application\Tenant\Service\WelcomeTenantService;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:test-welcome-email', description: 'Test l\'envoi du mail de bienvenue')]
class WelcomeEmailTest extends Command
{
    public function __construct(
        private WelcomeTenantService $welcomeTenantService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // 1. On simule un User CEO (Assure-toi que ton entité Domaine peut être instanciée ainsi)
        // Si ton entité User est complexe, utilise un Mock ou crée un objet simple
        $user = new User(firstName: new UserName("Woridge") , lastName: new UserName("Test User") , email:new Email("ahmedrdp2@gmail.com") ,password: "shhdsqddsq");


        $subdomain = 'ehei-domain';

        $io->title("Envoi d'un mail de test pour le tenant : $subdomain");

        try {
            $this->welcomeTenantService->execute($user, $subdomain);
            $io->success("Le mail a été envoyé avec succès via Brevo !");
        } catch (\Exception $e) {
            $io->error("Échec de l'envoi : " . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
