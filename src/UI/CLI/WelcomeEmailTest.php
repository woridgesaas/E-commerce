<?php

namespace App\UI\CLI;

use App\Application\Provisioning\Message\TenantProvisioningFinishedEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:test-welcome-email', description: 'Test l\'envoi du mail de bienvenue')]
class WelcomeEmailTest extends Command
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
    ) {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->setDescription('Sending activation email for a subscription')
            ->addArgument('subscriptionId', InputArgument::REQUIRED, 'The subscription ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $subscriptionId = (int) $input->getArgument('subscriptionId');
        try {

            $this->eventDispatcher->dispatch(
                new TenantProvisioningFinishedEvent($subscriptionId)
            );

        $output->writeln('<comment>Provisioning event has ben triggered :) !.</comment>');
        } catch (\Exception $e) {
            $output->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
