<?php

namespace Raketa\BackendTestTask\Domain\Exception;

use Exception;
use Throwable;

class ProductNotFoundException extends ProductException {

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}