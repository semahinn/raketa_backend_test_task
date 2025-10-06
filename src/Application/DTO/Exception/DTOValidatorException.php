<?php

namespace Raketa\BackendTestTask\Application\DTO\Exception;

class DTOValidatorException extends \Exception {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }
}