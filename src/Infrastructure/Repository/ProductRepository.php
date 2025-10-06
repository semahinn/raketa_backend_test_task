<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Raketa\BackendTestTask\Domain\Entity\Product;
use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryException;
use Raketa\BackendTestTask\Domain\Exception\CategoryNotFoundException;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;
use Raketa\BackendTestTask\Domain\Exception\ProductException;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Domain\Factory\ProductFactoryInterface;
use Raketa\BackendTestTask\Domain\RawResult\ProductRowResult;
use Raketa\BackendTestTask\Domain\Repository\CategoryRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        protected Connection $connection,
        protected ProductFactoryInterface $factory) {
    }

    public function getByUuid(string $uuid): ?ProductInterface
    {
        $row = $this->connection->fetchOne(
          "SELECT * FROM product WHERE uuid = :uuid", ['uuid' => $uuid], ['uuid' => ParameterType::STRING]
        );

        if (empty($row)) {
            return null;
        }

        return $this->fromRow($row);
    }

    public function getByCategory(int $categoryId): array
    {
        return array_map(
            fn (array $row): ProductInterface => $this->fromRow($row),
            $this->connection->fetchAllAssociative(
                "SELECT * FROM product WHERE category_id = :category_id",
                ['category_id' => $categoryId], ['category_id' => ParameterType::INTEGER]
            )
        );
    }

    /**
     * @throws ProductRepositoryException
     */
    protected function fromRow(array $row): ProductInterface
    {
        try {
            $rowResult = ProductRowResult::fromRow($row);
        }
        catch (\TypeError $e) {
            throw new ProductRepositoryException("Получены некорректные данные о товаре из базы данных", $e);
        }

        try {
            $this->validate($rowResult);
            return $this->factory->createFromRowResult($rowResult);
        }
        catch (\Exception $e) {
            throw new ProductRepositoryException($e->getMessage(), $e);
        }
    }

    protected function validate(ProductRowResult $rowResult): void
    {
        // Здесь должна быть валидация экземпляра $rowResult. Например, можно использовать symfony/validator.
        // Тогда мы сможем проверить, опираясь на ограничения, прикреплённые к свойствам класса ProductRawResult
        // ...
        // throw new ProductRepositoryException("Значение свойства '$property' не прошло проверку");
    }
}
