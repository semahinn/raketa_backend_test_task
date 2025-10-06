<?php

namespace Raketa\BackendTestTask\Infrastructure\View;

use Raketa\BackendTestTask\Domain\Entity\ProductInterface;

readonly class ProductsView
{
    public function __construct(
    ) {
    }

    /**
     * @param ProductInterface[] $products
     */
    public function toArray(array $products): array
    {
        return array_map(
            fn (ProductInterface $product) => [
                'id' => $product->getId(),
                'uuid' => $product->getUuid(),
                'category' => $product->getCategory(),
                'description' => $product->getDescription(),
                'thumbnail' => $product->getThumbnail(),
                'price' => $product->getPrice(),
            ],
            $products
        );
    }
}
