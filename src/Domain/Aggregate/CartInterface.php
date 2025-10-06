<?php

namespace Raketa\BackendTestTask\Domain\Aggregate;

use Raketa\BackendTestTask\Domain\Entity\CustomerInterface;
use Raketa\BackendTestTask\Domain\ValueObject\CartItem;

interface CartInterface {

    public function getUuid(): string;

    public function getCustomer(): CustomerInterface;

    public function getPaymentMethod(): string;

    /**
     * @return CartItem[]
     */
    public function getItems(): array;

    public function addItem(CartItem $item): static;
}