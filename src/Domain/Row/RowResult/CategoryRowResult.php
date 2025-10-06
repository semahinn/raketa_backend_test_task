<?php

namespace Raketa\BackendTestTask\Domain\Row\RowResult;

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
          $row['id'] ?? 0,
          $row['name'] ?? '');
    }

}