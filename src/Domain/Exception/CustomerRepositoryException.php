<?php

namespace Raketa\BackendTestTask\Domain\Exception;

use Throwable;

class CustomerRepositoryException extends CustomerException {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}