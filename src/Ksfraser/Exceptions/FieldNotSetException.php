<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

class FieldNotSetException extends KsfStatusException
{
    public function __construct(string $message = 'Required field not set', ?\Throwable $previous = null)
    {
        parent::__construct($message, defined('KSF_FIELD_NOT_SET') ? (int) KSF_FIELD_NOT_SET : 1001, $previous);
    }
}
