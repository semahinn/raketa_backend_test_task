<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Raketa\BackendTestTask\Domain\Entity\ProductInterface;
use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Domain\Factory\ProductFactoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;
use Raketa\BackendTestTask\Domain\Row\RowValidator\ProductRowValidator;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        protected Connection $connection,
        protected ProductFactoryInterface $factory,
        protected ProductRowValidator $rowValidator) {
    }

    public function getByUuid(string $uuid): ?ProductInterface
    {
        $row = $this->connection->fetchAssociative(
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
            return $this->factory->createFromRowResult($this->rowValidator->validate($row));
        }
        catch (\Exception $e) {
            throw new ProductRepositoryException('', $e);
        }
    }

}
