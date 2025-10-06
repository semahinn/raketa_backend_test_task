<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;
use Raketa\BackendTestTask\Domain\Exception\CartRepositoryException;

interface CartRepositoryInterface
{
    /**
     * @throws CartRepositoryException
     */
    public function save(CartInterface $cart, int $ttl = 60): void;

    /**
     * @throws CartRepositoryException
     */
    public function getByUuid(string $uuid): ?CartInterface;

}