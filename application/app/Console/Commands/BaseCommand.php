<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{
    public function logError(string $errorContext, Throwable $exception): void
    {
        $this->error(sprintf(
            '%s - %s on %s at line #%d',
            $errorContext,
            $exception->getMessage(),
            basename($exception->getFile()),
            $exception->getLine(),
        ));
    }
}
