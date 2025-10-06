<?php

namespace Raketa\BackendTestTask\Application\DTO\DTO;

final readonly class GetCartDTO {

    public function __construct(
        public string $cartUuid,
    ) {
    }

}