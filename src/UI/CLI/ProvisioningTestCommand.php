<?php

namespace App\UI\CLI;

use App\Application\Provisioning\Command\ProvisioningCommand;
use App\Application\Provisioning\Message\TenantModuleReadyEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:provisioning:test')]
class ProvisioningTestCommand extends Command
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private EventDispatcherInterface $eventDispatcher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Provision database for a subscription')
            ->addArgument('subscriptionId', InputArgument::REQUIRED, 'The subscription ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $subscriptionId = (int) $input->getArgument('subscriptionId');


        $command = new ProvisioningCommand($subscriptionId);
        $this->messageBus->dispatch($command);

        $output->writeln('<info>Message de provisioning envoyé au bus (RabbitMQ) !</info>');
        $output->writeln('<comment>Vérifiez votre worker pour voir l\'exécution.</comment>');



        return Command::SUCCESS;
    }
}
