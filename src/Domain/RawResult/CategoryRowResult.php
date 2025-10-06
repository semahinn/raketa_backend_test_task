<?php

namespace Raketa\BackendTestTask\Domain\RawResult;

use TypeError;

final readonly class CategoryRowResult {

    public function __construct(
        public ?int $id,
        public string $name
    ) {
    }

    /**
     * @throws TypeError
     */
    public static function fromRow(array $row): self
    {
        return new CategoryRowResult(
          $row['id'] ?? null,
          $row['name'] ?? '');
    }

}