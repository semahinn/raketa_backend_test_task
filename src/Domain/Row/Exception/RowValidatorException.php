<?php

namespace Raketa\BackendTestTask\Domain\Row\Exception;

use Throwable;
use Exception;

class RowValidatorException extends Exception {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}