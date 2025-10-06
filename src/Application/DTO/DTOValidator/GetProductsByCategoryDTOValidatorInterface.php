<?php

namespace Raketa\BackendTestTask\Application\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\GetProductsByCategoryDTO;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;

interface GetProductsByCategoryDTOValidatorInterface {

    /**
     * @throws DTOValidatorException
     */
    public function validate(array $input): GetProductsByCategoryDTO;
}