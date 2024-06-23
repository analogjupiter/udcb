<?php

declare(strict_types=1);

namespace Udcb\Udcb\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Udcb\Udcb\Meta\CompilerList;

#[AsCommand(
    name: 'make:avail',
    description: 'Check whether the requested compiler is available to build.'
)]
final class MakeAvailCommand extends CompilerNameVersionCommand
{
    public function __construct(
        private readonly CompilerList $compilerList,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('compiler-name');
        $version = $input->getArgument('version');
        $available = $this->compilerList->hasCompiler($name, $version);

        if (!$available) {
            $output->writeln('<error>Not available.</error>');
            return self::FAILURE;
        }

        $output->writeln('<info>Available.</info>');
        return self::SUCCESS;
    }
}
