<?php

declare(strict_types=1);

namespace Udcb\Udcb\Meta;

use Exception;
use Udcb\Udcb\Util\AAWrapper;
use Udcb\Udcb\Util\Ini\IniLoader;

final class CompilerList
{
    private AAWrapper $data;

    /**
     * @throws BadStaticDataException
     */
    public function __construct(
        string $path,
        IniLoader $iniLoader,
    ) {
        try {
            $this->data = $iniLoader->loadWrapped($path);
        } catch (Exception $ex) {
            throw new BadStaticDataException($ex->getMessage());
        }
    }

    public function hasCompiler(string $name, string $version): bool
    {
        $key = "{$name}:{$version}";
        return $this->data->has($key);
    }

    public function getCompilers(): array
    {
        $result = [];

        foreach ($this->data->getArray() as $compiler => $meta) {
            $entry = explode(':', $compiler);
            if (count($entry) !== 2) {
                continue;
            }
            $result[$entry[0]][] = $entry[1];
        }

        ksort($result);

        foreach ($result as &$compiler) {
            natsort($compiler);
        }

        return $result;
    }
}
