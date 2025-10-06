<?php

namespace Raketa\BackendTestTask\Domain\Factory;

use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\RawResult\CategoryRowResult;

interface CategoryFactoryInterface
{
    public function createFromRowResult(CategoryRowResult $rawResult): CategoryInterface;
}