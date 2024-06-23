<?php

declare(strict_types=1);

namespace Udcb\Udcb\Meta;

use Exception;
use Udcb\Udcb\Util\AAWrapper;
use Udcb\Udcb\Util\Ini\IniLoader;

final class SystemConfig
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

    public function getDataPath(): string
    {
        return $this->getRequiredValue('udcb', 'data_dir');
    }

    /**
     * @throws BadStaticDataException
     */
    private function getRequiredValue(string $section, string $key): string
    {
        $value = $this->data->get($section, $key);

        if ($value === null) {
            throw new BadStaticDataException(
                "Bad system config: Required field `{$key}` is missing in section `{$section}`."
            );
        }

        return $value;
    }
}
