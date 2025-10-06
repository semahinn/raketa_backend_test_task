<?php

namespace Raketa\BackendTestTask\Infrastructure\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\GetProductsByCategoryDTO;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\GetProductsByCategoryDTOValidatorInterface;

class GetProductsByCategoryDTOValidator implements GetProductsByCategoryDTOValidatorInterface {

    public function process(?array $input = []): GetProductsByCategoryDTO
    {
        // По условию этого задания предполагается, что валидация УЖЕ есть в реальном проекте
        // Предположим, что здесь должна быть логика валидации массива $input для создания DTO
        // ...
        $dto = new GetProductsByCategoryDTO($input['categoryId']);
        // Предположим, что здесь должна быть логика валидации самого $dto, которая может породить DTOValidatorException
        // ...
        return $dto;
    }
}