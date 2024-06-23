<?php

declare(strict_types=1);

namespace Udcb\Udcb\Meta;

use Udcb\Udcb\Ex\FatalErrorException;

class BadStaticDataException extends FatalErrorException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
