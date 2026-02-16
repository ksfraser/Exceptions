<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

use Exception;

abstract class CustomException extends Exception implements IException
{
    /** @var mixed */
    private $string;

    public function __construct($message = null, $code = 0)
    {
        if ($message === null || $message === '') {
            $message = 'Unknown ' . static::class;
        }

        parent::__construct((string)$message, (int)$code);
    }

    public function __toString(): string
    {
        return static::class . " '{$this->message}' in {$this->file}({$this->line})\n" . $this->getTraceAsString();
    }
}
