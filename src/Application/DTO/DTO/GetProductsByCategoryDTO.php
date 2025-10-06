<?php

namespace Raketa\BackendTestTask\Application\DTO\DTO;

final readonly class GetProductsByCategoryDTO {

    public function __construct(
        public int $categoryId,
    ) {
    }

}