<?php

namespace Raketa\BackendTestTask\Domain\Factory;

use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\Row\RowResult\CategoryRowResult;

interface CategoryFactoryInterface
{
    public function createFromRowResult(CategoryRowResult $rawResult): CategoryInterface;
}