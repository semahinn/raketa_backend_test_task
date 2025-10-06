<?php

namespace Raketa\BackendTestTask\Application\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\GetCartDTO;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;

interface GetCartDTOValidatorInterface {

    /**
     * @throws DTOValidatorException
     */
    public function process(): GetCartDTO;
}