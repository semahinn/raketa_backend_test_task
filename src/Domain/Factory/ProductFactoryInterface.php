<?php

namespace Raketa\BackendTestTask\Domain\Factory;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;
use Raketa\BackendTestTask\Domain\Row\RowResult\ProductRowResult;

interface ProductFactoryInterface
{
    /**
     * @throws CategoryNotFoundException
     * @throws CategoryRepositoryException
     */
    public function createFromRowResult(ProductRowResult $rawResult): ProductInterface;
}