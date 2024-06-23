<?php

declare(strict_types=1);

namespace Udcb\Udcb;

use DI\Container as DIContainer;
use Psr\Container\ContainerInterface as Container;
use Symfony\Component\Console\Application;
use Udcb\Udcb\Console\ConsoleApplicationFactory;

final class Di
{
    private const pathRoot = __DIR__ . '/../../..';
    private const pathEtc = self::pathRoot . '/etc';
    private const pathLib = self::pathRoot . '/lib';
    private const pathLibUdcbMeta = self::pathLib . '/udcb/meta';

    public static function setup(): Container
    {
        return new DIContainer(self::getConfig());
    }

    private static function getConfig(): array
    {
        return [
            Application::class => function (Container $c) {
                return $c->get(ConsoleApplicationFactory::class)->make();
            },

            \Udcb\Udcb\Meta\CompilerList::class => function (Container $c) {
                return new \Udcb\Udcb\Meta\CompilerList(
                    self::pathLibUdcbMeta . '/compilers.ini',
                    $c->get(\Udcb\Udcb\Util\Ini\IniLoader::class),
                );
            },

            \Udcb\Udcb\Meta\RecipeList::class => function (Container $c) {
                return new \Udcb\Udcb\Meta\RecipeList(
                    self::pathLibUdcbMeta . '/rcipes.ini',
                    $c->get(\Udcb\Udcb\Util\Ini\IniLoader::class),
                );
            },

            \Udcb\Udcb\Meta\SystemConfig::class => function (Container $c) {
                return new \Udcb\Udcb\Meta\SystemConfig(
                    self::pathEtc . '/udcb.ini',
                    $c->get(\Udcb\Udcb\Util\Ini\IniLoader::class),
                );
            },
        ];
    }
}
