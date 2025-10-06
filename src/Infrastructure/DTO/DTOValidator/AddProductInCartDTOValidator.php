<?php

namespace Raketa\BackendTestTask\Infrastructure\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\AddProductInCartDTO;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\AddProductInCartDTOValidatorInterface;

class AddProductInCartDTOValidator implements AddProductInCartDTOValidatorInterface {

    public function process(?array $input = []): AddProductInCartDTO
    {
        // По условию этого задания предполагается, что валидация УЖЕ есть в реальном проекте
        // Предположим, что здесь должна быть логика валидации массива $input для создания DTO
        // ...
        $dto = new AddProductInCartDTO($input['productUuid'], $input['cartUuid'], $input['quantity']);
        // Предположим, что здесь должна быть логика валидации самого $dto, которая может породить DTOValidatorException
        // ...
        return $dto;
    }
}