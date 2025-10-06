<?php

namespace Raketa\BackendTestTask\Application\Service;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class ProductService {

    public function __construct(
        protected ProductRepositoryInterface $productRepository) {
    }

    /**
     * @return ProductInterface[]
     *
     * @throws ProductRepositoryException
     */
    public function getProductsByCategory(int $category_id): array
    {
        return $this->productRepository->getByCategory($category_id);
    }

    /**
     * @return ProductInterface[]
     *
     * @throws ProductRepositoryException
     */
    public function getProductsByUuids(array $uuids): array
    {
        $results = [];
        foreach ($uuids as $uuid)
            $results[$uuid] = $this->productRepository->getByUuid($uuid);
        return $results;
    }
}