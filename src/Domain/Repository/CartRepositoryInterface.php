<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;
use Raketa\BackendTestTask\Domain\Exception\CartRepositoryException;
use Raketa\BackendTestTask\Infrastructure\Connector\Exception\ConnectorException;

interface CartRepositoryInterface
{
    /**
     * @throws ConnectorException
     */
    public function save(CartInterface $cart, int $ttl = 60): void;

    /**
     * @throws CartRepositoryException
     * @throws ConnectorException
     */
    public function getByUuid(string $uuid): ?CartInterface;

}