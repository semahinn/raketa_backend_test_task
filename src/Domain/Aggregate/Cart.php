<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Aggregate;

use Raketa\BackendTestTask\Domain\Entity\CustomerInterface;
use Raketa\BackendTestTask\Domain\ValueObject\CartItem;

class Cart implements CartInterface
{
    public function __construct(
        protected readonly string $uuid,
        protected readonly CustomerInterface $customer,
        protected readonly string $paymentMethod,
        protected array $items = [],
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(CartItem $item): static
    {
        $this->items[$item->getUuid()] = $item;
        return $this;
    }
}
