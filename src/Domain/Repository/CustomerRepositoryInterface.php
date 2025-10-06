<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\CustomerInterface;
use Raketa\BackendTestTask\Domain\Exception\CustomerRepositoryException;

interface CustomerRepositoryInterface
{
    /**
     * @throws CustomerRepositoryException
     */
    public function getById(string $id): ?CustomerInterface;
}