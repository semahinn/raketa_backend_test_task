<?php

namespace Raketa\BackendTestTask\Domain\Factory;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryException;
use Raketa\BackendTestTask\Domain\Exception\CategoryNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;
use Raketa\BackendTestTask\Domain\RawResult\ProductRowResult;

interface ProductFactoryInterface
{
    /**
     * @throws CategoryNotFoundException
     * @throws CategoryRepositoryException
     */
    public function createFromRowResult(ProductRowResult $rawResult): ProductInterface;
}