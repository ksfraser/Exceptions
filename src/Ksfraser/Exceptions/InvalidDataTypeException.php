<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

class InvalidDataTypeException extends KsfStatusException
{
    public function __construct(string $message = 'Invalid data type', ?\Throwable $previous = null)
    {
        parent::__construct($message, defined('KSF_INVALID_DATA_TYPE') ? (int) KSF_INVALID_DATA_TYPE : 1002, $previous);
    }
}
