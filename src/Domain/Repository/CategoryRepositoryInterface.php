<?php

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;

interface CategoryRepositoryInterface
{
    /**
     * @throws CategoryRepositoryException
     */
    public function getById(int $id): ?CategoryInterface;
}