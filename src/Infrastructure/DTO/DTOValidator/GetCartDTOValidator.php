<?php

namespace Raketa\BackendTestTask\Infrastructure\DTO\DTOValidator;

use Raketa\BackendTestTask\Application\DTO\DTO\GetCartDTO;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\GetCartDTOValidatorInterface;

class GetCartDTOValidator implements GetCartDTOValidatorInterface {

    public function process(?array $input = []): GetCartDTO
    {
        // По условию этого задания предполагается, что валидация УЖЕ есть в реальном проекте
        // Предположим, что здесь должна быть логика валидации массива $input для создания DTO
        // ...
        $dto = new GetCartDTO($input['cartUuid']);
        // Предположим, что здесь должна быть логика валидации самого $dto, которая может породить DTOValidatorException
        // ...
        return $dto;
    }
}