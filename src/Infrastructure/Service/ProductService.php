<?php

namespace Raketa\BackendTestTask\Infrastructure\Service;

use Raketa\BackendTestTask\Application\DTO\DTO\GetProductsByCategoryDTO;
use Raketa\BackendTestTask\Application\Service\ProductServiceInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface {

    public function __construct(
        protected ProductRepositoryInterface $productRepository) {
    }

    public function getProductsByCategory(GetProductsByCategoryDTO $dto): array
    {
        return $this->productRepository->getByCategory($dto->categoryId);
    }
}