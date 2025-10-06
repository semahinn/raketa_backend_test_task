<?php

namespace Raketa\BackendTestTask\Infrastructure\Service;

use Raketa\BackendTestTask\Application\DTO\DTO\AddProductInCartDTO;
use Raketa\BackendTestTask\Application\DTO\DTO\GetCartDTO;
use Raketa\BackendTestTask\Application\Service\CartServiceInterface;
use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;
use Raketa\BackendTestTask\Domain\Exception\CartNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\ProductNotFoundException;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;
use Raketa\BackendTestTask\Domain\ValueObject\CartItem;

class CartService implements CartServiceInterface {

    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected CartRepositoryInterface $cartRepository) {
    }

    public function addProductInCart(AddProductInCartDTO $dto): CartInterface {
        $product = $this->productRepository->getByUuid($dto->productUuid);
        if (!$product)
            throw new ProductNotFoundException("Товара с uuid '$dto->productUuid' не существует");

        $cart = $this->cartRepository->getByUuid($dto->cartUuid);
        if (!$cart)
            throw new CartNotFoundException("Корзины с uuid '$dto->cartUuid' не существует");

        $cart->addItem(new CartItem(
            $dto->cartUuid,
            $product,
            $dto->quantity,
        ));

        $this->cartRepository->save($cart, 24 * 60 * 60);
        return $cart;
    }

    public function getCartByUuid(GetCartDTO $dto): CartInterface {
        $cart = $this->cartRepository->getByUuid($dto->cartUuid);
        if (!$cart)
            throw new CartNotFoundException("Корзины с uuid '$dto->cartUuid' не существует");

        return $cart;
    }

}