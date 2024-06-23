<?php

namespace Udcb\Udcb;

use Exception;
use Symfony\Component\Console\Application as ConsoleApplication;

final class App
{
    public static function main(): int
    {
        return self::getDiApp();
    }

    private static function getDiApp(): int
    {
        $container = Di::setup();

        try {
            $app = $container->get(ConsoleApplication::class);
        } catch (Exception $ex) {
            echo 'Error: App initialization failed.', PHP_EOL, $ex->getMessage(), PHP_EOL;
            return 1;
        }

        return $app->run();
    }
}
