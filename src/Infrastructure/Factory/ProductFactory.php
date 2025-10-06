<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Factory;

use Raketa\BackendTestTask\Domain\Entity\Product;
use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryNotFoundException;
use Raketa\BackendTestTask\Domain\Factory\ProductFactoryInterface;
use Raketa\BackendTestTask\Domain\Repository\CategoryRepositoryInterface;
use Raketa\BackendTestTask\Domain\Row\RowResult\ProductRowResult;

class ProductFactory implements ProductFactoryInterface
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository) {
    }

    public function createFromRowResult(ProductRowResult $rawResult): ProductInterface
    {
        $category = $this->categoryRepository->getById($rawResult->categoryId);
        if (!$category) {
            throw new CategoryNotFoundException("Категории товаров с id '$rawResult->categoryId' не существует");
        }

        return new Product(
            $rawResult->id,
            $rawResult->uuid,
            $rawResult->isActive,
            $category,
            $rawResult->name,
            $rawResult->description,
            $rawResult->thumbnail,
            $rawResult->price,
        );
    }
}