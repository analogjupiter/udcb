<?php

declare(strict_types=1);

namespace Udcb\Udcb\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

abstract class CompilerNameVersionCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected final function configure(): void
    {
        $this->addArgument(
            'compiler-name',
            InputArgument::REQUIRED,
            'The name of the compiler to build.'
        );
        $this->addArgument(
            'version',
            InputArgument::REQUIRED,
            'The version to build.'
        );
    }
}
