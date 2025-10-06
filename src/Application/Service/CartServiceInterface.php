<?php

namespace Raketa\BackendTestTask\Application\Service;

use Raketa\BackendTestTask\Application\DTO\DTO\AddProductInCartDTO;
use Raketa\BackendTestTask\Application\DTO\DTO\GetCartDTO;
use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;
use Raketa\BackendTestTask\Domain\Exception\CartNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\CartRepositoryException;
use Raketa\BackendTestTask\Domain\Exception\ProductNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Infrastructure\Connector\Exception\ConnectorException;

interface CartServiceInterface {

    /**
     * @throws CartNotFoundException
     * @throws CartRepositoryException
     * @throws ProductNotFoundException
     * @throws ProductRepositoryException
     * @throws ConnectorException
     */
    public function addProductInCart(AddProductInCartDTO $dto): CartInterface;

    /**
     * @throws CartNotFoundException
     * @throws CartRepositoryException
     * @throws ConnectorException
     */
    public function getCartByUuid(GetCartDTO $dto): CartInterface;
}