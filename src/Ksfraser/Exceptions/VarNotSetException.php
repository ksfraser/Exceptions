<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

class VarNotSetException extends KsfStatusException
{
    public function __construct(string $message = 'Required variable not set', ?\Throwable $previous = null)
    {
        parent::__construct($message, defined('KSF_VAR_NOT_SET') ? (int) KSF_VAR_NOT_SET : 1004, $previous);
    }
}
