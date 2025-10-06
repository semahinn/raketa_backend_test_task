<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\ValueObject;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;

final readonly class CartItem
{
    public function __construct(
        private string $uuid,
        private ProductInterface $product,
        private float $price,
        private int $quantity,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
