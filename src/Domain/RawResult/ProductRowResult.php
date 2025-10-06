<?php

namespace Raketa\BackendTestTask\Domain\RawResult;

use TypeError;

final readonly class ProductRowResult {

    public function __construct(
        public ?int $id,
        public string $uuid,
        public bool $isActive,
        public int $categoryId,
        public string $name,
        public string $description,
        public string $thumbnail,
        public float $price,
    ) {
    }

    /**
     * @throws TypeError
     */
    public static function fromRow(array $row): self
    {
        return new ProductRowResult(
            $row['id'] ?? null,
            $row['uuid'] ?? '',
            $row['isActive'] ?? false,
            $row['categoryId'] ?? 0,
            $row['name'] ?? '',
            $row['description'] ?? '',
            $row['thumbnail'] ?? '',
            $row['price'] ?? 0);
    }
}