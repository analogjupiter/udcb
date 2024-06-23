<?php

declare(strict_types=1);

namespace Udcb\Udcb\Util\Ini;

use Exception;
use Udcb\Udcb\Util\AAWrapper;

final class IniLoader
{
    /**
     * @throws Exception
     */
    public function load(string $path): array
    {
        if (!file_exists($path)) {
            $baseName = basename($path);
            throw new Exception("Cannot load `{$baseName}`: File `{$path}` does not exist.");
        }

        $iniData = parse_ini_file($path, true, INI_SCANNER_RAW);
        if ($iniData === false) {
            $baseName = basename($path);
            throw new Exception("Bad `' . {$baseName} . '`: Invalid INI syntax.");
        }

        return $iniData;
    }

    /**
     * @throws Exception
     */
    public function loadWrapped(string $path): AAWrapper
    {
        $iniData = $this->load($path);
        return new AAWrapper($iniData);
    }
}
