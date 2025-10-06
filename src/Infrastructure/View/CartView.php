<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\View;

use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;

readonly class CartView
{
    public function __construct(
    ) {
    }

    public function toArray(CartInterface $cart): array
    {
        $data = [
            'uuid' => $cart->getUuid(),
            'customer' => [
                'id' => $cart->getCustomer()->getId(),
                'name' => implode(' ', [
                    $cart->getCustomer()->getLastName(),
                    $cart->getCustomer()->getFirstName(),
                    $cart->getCustomer()->getMiddleName(),
                ]),
                'email' => $cart->getCustomer()->getEmail(),
            ],
            'payment_method' => $cart->getPaymentMethod(),
        ];

        $total = 0;
        $data['items'] = [];
        foreach ($cart->getItems() as $item) {
            $product = $item->getProduct();
            $total += $product->getPrice() * $item->getQuantity();

            $data['items'][] = [
                'uuid' => $item->getUuid(),
                'price' => $product->getPrice(),
                'total' => $total,
                'quantity' => $item->getQuantity(),
                'product' => [
                    'id' => $product->getId(),
                    'uuid' => $product->getUuid(),
                    'name' => $product->getName(),
                    'thumbnail' => $product->getThumbnail(),
                    'price' => $product->getPrice(),
                ],
            ];
        }

        $data['total'] = $total;

        return $data;
    }
}
