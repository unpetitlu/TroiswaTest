<?php

namespace Troiswa\TestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:test') // nom de la commande
            ->setDescription('Saluer une personne') // description de la commande
            ->addArgument('name', InputArgument::OPTIONAL, 'Qui voulez vous saluer ?')
            ->addOption('upper', null, InputOption::VALUE_NONE, 'Si définie, la tâche criera en majuscules')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Bonjour '.$name;
        } else {
            $text = 'Bonjour';
        }

        if ($input->getOption('upper')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);

        $message = new \Swift_Message();
        $message->setSubject('Hello Email')
                        ->setFrom('send@example.com')
                        ->setTo('ludo.verrecchia@gmail.com')
                        ->setBody('Coucou, ceci est un test');

        // ... préparez le message

        $container = $this->getContainer();
        $mailer = $container->get('mailer');

        $mailer->send($message);

        // maintenant nettoyez la file manuellement
        $spool = $mailer->getTransport()->getSpool();
        $transport = $container->get('swiftmailer.transport.real');

        $spool->flushQueue($transport);
    }
}