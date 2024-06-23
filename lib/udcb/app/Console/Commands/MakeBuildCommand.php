<?php

declare(strict_types=1);

namespace Udcb\Udcb\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Udcb\Udcb\Meta\CompilerList;

#[AsCommand(
    name: 'make:build',
    description: 'Build the requested compiler.'
)]
final class MakeBuildCommand extends CompilerNameVersionCommand
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
            // Try to sanitize input.
            if (str_starts_with($version, 'v')) {
                $version = substr($version, 1);
                $available = $this->compilerList->hasCompiler($name, $version);
            }
        }

        if (!$available) {
            $output->writeln('<error>The requested compiler version is not available.</error>');
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
