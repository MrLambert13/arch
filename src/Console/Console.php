<?php


namespace Console;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Console extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:main')
            ->setDescription('Main console command.')
            ->setHelp('This is main console command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Console start');
    }
}