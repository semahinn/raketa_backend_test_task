<?php

namespace Raketa\BackendTestTask\Domain\Row\RowValidator;

use Raketa\BackendTestTask\Domain\Row\Exception\RowValidatorException;
use Raketa\BackendTestTask\Domain\Row\RowResult\ProductRowResult;

interface ProductRowValidatorInterface {

    /**
     * @throws RowValidatorException
     */
    public function validate(array $row): ProductRowResult;
}