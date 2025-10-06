<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;

interface ProductRepositoryInterface
{
    /**
     * @throws ProductRepositoryException
     */
    public function getByUuid(string $uuid): ?ProductInterface;

    /**
     * @return ProductInterface[]
     *
     * @throws ProductRepositoryException
     */
    public function getByCategory(int $categoryId): array;

}