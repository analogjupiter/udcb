<?php

declare(strict_types=1);

namespace Udcb\Udcb\Meta;

use Exception;
use Udcb\Udcb\Util\AAWrapper;
use Udcb\Udcb\Util\Ini\IniLoader;

class RecipeList
{
    private AAWrapper $data;

    /**
     * @throws BadStaticDataException
     */
    public function __construct(
        string $path,
        IniLoader $iniLoader,
    )
    {
        try {
            $this->data = $iniLoader->loadWrapped($path);
        } catch (Exception $ex) {
            throw new BadStaticDataException($ex->getMessage());
        }
    }
}
