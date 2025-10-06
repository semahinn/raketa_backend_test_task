<?php

namespace Raketa\BackendTestTask\Application\DTO\Exception;

use Throwable;
use Exception;

class DTOValidatorException extends Exception {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }
}