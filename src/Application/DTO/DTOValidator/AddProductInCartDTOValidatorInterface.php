<?php

namespace Raketa\BackendTestTask\Application\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\AddProductInCartDTO;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;

interface AddProductInCartDTOValidatorInterface {

    /**
     * @throws DTOValidatorException
     */
    public function process(): AddProductInCartDTO;
}