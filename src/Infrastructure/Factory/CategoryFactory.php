<?php

namespace Raketa\BackendTestTask\Infrastructure\Factory;

use Raketa\BackendTestTask\Domain\Entity\Category;
use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\Factory\CategoryFactoryInterface;
use Raketa\BackendTestTask\Domain\RawResult\CategoryRowResult;

class CategoryFactory implements CategoryFactoryInterface
{
    public function createFromRowResult(CategoryRowResult $rawResult): CategoryInterface
    {
        return new Category(
            $rawResult->id,
            $rawResult->name,
        );
    }
}