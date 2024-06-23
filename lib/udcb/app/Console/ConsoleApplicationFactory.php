<?php

declare(strict_types=1);

namespace Udcb\Udcb\Console;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application as ConsoleApplication;
use Udcb\Udcb\Console;

final class ConsoleApplicationFactory
{
    private const appName = 'Universal D Compiler Installer';
    private const appPackage = 'udcb/udcb';

    public function __construct(
        private ContainerInterface $container,
    ) {
    }

    public function make(): ConsoleApplication
    {
        $version = \Composer\InstalledVersions::getPrettyVersion(self::appPackage);
        $app = new ConsoleApplication(self::appName, $version);

        $app->setCatchExceptions(true);
        $app->setCatchErrors(true);

        // Register commands
        $app->add($this->container->get(Console\Commands\MakeAvailCommand::class));
        $app->add($this->container->get(Console\Commands\MakeBuildCommand::class));
        $app->add($this->container->get(Console\Commands\MakeListCommand::class));

        return $app;
    }
}
