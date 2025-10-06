<?php

namespace Raketa\BackendTestTask\Domain\Exception;

use Throwable;

class CartNotFoundException extends CartException {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}