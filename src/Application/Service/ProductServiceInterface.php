<?php

namespace Raketa\BackendTestTask\Application\Service;

use Raketa\BackendTestTask\Application\DTO\DTO\GetProductsByCategoryDTO;
use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;

interface ProductServiceInterface {

    /**
     * @return ProductInterface[]
     *
     * @throws ProductRepositoryException
     */
    public function getProductsByCategory(GetProductsByCategoryDTO $dto): array;
}