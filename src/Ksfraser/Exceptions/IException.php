<?php

declare(strict_types=1);

namespace Ksfraser\Exceptions;

interface IException
{
    public function getMessage();

    public function getCode();

    public function getFile();

    public function getLine();

    public function getTrace();

    public function getTraceAsString();

    public function __toString();

    public function __construct($message = null, $code = 0);
}
