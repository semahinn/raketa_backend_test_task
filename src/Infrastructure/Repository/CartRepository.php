<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Repository;

use Raketa\BackendTestTask\Domain\Aggregate\Cart;
use Raketa\BackendTestTask\Domain\Aggregate\CartInterface;
use Raketa\BackendTestTask\Domain\Exception\CartRepositoryException;
use Raketa\BackendTestTask\Domain\Exception\CustomerRepositoryException;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\CustomerRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;
use Raketa\BackendTestTask\Domain\ValueObject\CartItem;
use Raketa\BackendTestTask\Infrastructure\Connector\Connector\ConnectorInterface;
use Raketa\BackendTestTask\Infrastructure\Connector\Exception\ConnectorException;
use Raketa\BackendTestTask\Infrastructure\Connector\Factory\ConnectorFacadeFactoryInterface;

class CartRepository implements CartRepositoryInterface
{
    protected ConnectorInterface $connector;

    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected CustomerRepositoryInterface $customerRepository,
        protected ConnectorFacadeFactoryInterface $connectorFacadeFactory,
        string $realConnectorFacadeClass,
        array $connectorOptions = [])
    {
        $this->connector = $this->connectorFacadeFactory->create($realConnectorFacadeClass, $connectorOptions)->getConnector();
    }

    public function save(CartInterface $cart, int $ttl = 60): void
    {
        $this->connector->set($cart->getUuid(), $this->toArray($cart), $ttl);
    }

    public function getByUuid(string $uuid): ?CartInterface
    {
        $result = $this->connector->get($uuid);
        if (!$result) return null;
        return $this->fromArray($result);
    }

    protected function toArray(CartInterface $cart): array
    {
        $json = json_encode($cart);
        $values = json_decode($json, true);

        $values['customer'] = $cart->getCustomer()->getId();
        foreach ($cart->getItems() as $key => $item) {
            $values['items'][$key]['productUuid'] = $item->getProduct();
        }

        return $values;
    }

    /**
     * @throws CartRepositoryException
     */
    protected function fromArray(array $values): CartInterface
    {
        try {
            $customer = $this->customerRepository->getById($values['customer']);
        } catch (\Exception $e) {
            throw new CartRepositoryException($e->getMessage(), $e);
        }

        if (!$customer)
            throw new CartRepositoryException("Пользователя с id '{$customer->getId()}' не существует");

        $cart = new Cart($values['uuid'], $customer, $values['paymentMethod']);
        foreach ($values['items'] as $key => $item) {
            try {
                $product = $this->productRepository->getByUuid($item[$key]['uuid']);
            } catch (\Exception $e) {
                throw new CartRepositoryException($e->getMessage(), $e);
            }

            if (!$product)
                throw new CartRepositoryException("Товара с uuid '{$item[$key]['uuid']}' не существует");

            $cart->addItem(new CartItem($item[$key]['uuid'], $product, $item[$key]['productUuid'], $item[$key]['quantity']));
        }

        return $cart;
    }
}
