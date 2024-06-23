<?php

declare(strict_types=1);

namespace Udcb\Udcb\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Udcb\Udcb\Meta\CompilerList;

#[AsCommand(
    name: 'make:list',
    description: 'List all compilers available to build.',
)]
final class MakeListCommand extends Command
{
    public function __construct(
        private readonly CompilerList $compilerList,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->compilerList->getCompilers() as $compiler => $versions) {
            foreach ($versions as $version) {
                $output->writeln("{$compiler}:{$version}");
            }
        }

        return self::SUCCESS;
    }
}
