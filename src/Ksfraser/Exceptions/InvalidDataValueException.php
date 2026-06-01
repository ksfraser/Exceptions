<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

class InvalidDataValueException extends KsfStatusException
{
    public function __construct(string $message = 'Invalid data value', ?\Throwable $previous = null)
    {
        parent::__construct($message, defined('KSF_INVALID_DATA_VALUE') ? (int) KSF_INVALID_DATA_VALUE : 1003, $previous);
    }
}
