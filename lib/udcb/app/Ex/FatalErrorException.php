<?php

declare(strict_types=1);

namespace Udcb\Udcb\Ex;

use Exception;

class FatalErrorException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
