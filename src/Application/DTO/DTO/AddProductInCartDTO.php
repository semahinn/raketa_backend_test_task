<?php

namespace Raketa\BackendTestTask\Application\DTO\DTO;

final readonly class AddProductInCartDTO {

    public function __construct(
        public string $productUuid,
        public string $cartUuid,
        public string $quantity
    ) {
    }

}