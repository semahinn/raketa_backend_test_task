<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;
use Raketa\BackendTestTask\Domain\Factory\CategoryFactoryInterface;
use Raketa\BackendTestTask\Domain\RawResult\CategoryRowResult;
use Raketa\BackendTestTask\Domain\Repository\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        protected Connection $connection,
        protected CategoryFactoryInterface $factory) {
    }

    public function getById(int $id): ?CategoryInterface
    {
        $row = $this->connection->fetchOne(
          "SELECT * FROM catefory WHERE id = :id", ['id' => $id], ['id' => ParameterType::STRING]
        );

        if (empty($row)) {
            return null;
        }

        return $this->fromRow($row);
    }

    /**
     * @throws CategoryRepositoryException
     */
    protected function fromRow(array $row): CategoryInterface
    {
        try {
            $rawResult = CategoryRowResult::fromRow($row);
        }
        catch (\TypeError $e) {
            throw new CategoryRepositoryException("Получены некорректные данные о записи категории товаров из базы данных", $e);
        }

        $this->validate($rawResult);
        return $this->factory->createFromRowResult($rawResult);
    }

    protected function validate(CategoryRowResult $rowResult): void
    {
        // Здесь должна быть валидация экземпляра $rawResult. Например, можно использовать symfony/validator.
        // Тогда мы сможем проверить, опираясь на ограничения, прикреплённые к свойствам класса CategoryRowResult
        // ...
        // throw new CategoryRepositoryException("Значение свойства '$property' не прошло проверку");
    }
}
