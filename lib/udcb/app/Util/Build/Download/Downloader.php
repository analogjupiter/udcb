<?php

declare(strict_types=1);

namespace Udcb\Udcb\Util\Build\Download;

interface Downloader
{
    public function download(string $source, string $selector, string $target): void;
}
