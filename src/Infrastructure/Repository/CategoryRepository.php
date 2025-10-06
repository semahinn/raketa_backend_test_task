<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Raketa\BackendTestTask\Domain\Entity\CategoryInterface;
use Raketa\BackendTestTask\Domain\Exception\CategoryRepositoryException;
use Raketa\BackendTestTask\Domain\Factory\CategoryFactoryInterface;
use Raketa\BackendTestTask\Domain\Repository\CategoryRepositoryInterface;
use Raketa\BackendTestTask\Domain\Row\Exception\RowValidatorException;
use Raketa\BackendTestTask\Domain\Row\RowValidator\CategoryRowValidatorInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        protected Connection $connection,
        protected CategoryFactoryInterface $factory,
        protected CategoryRowValidatorInterface $rowValidator) {
    }

    public function getById(int $id): ?CategoryInterface
    {
        $row = $this->connection->fetchOne(
          "SELECT * FROM category WHERE id = :id", ['id' => $id], ['id' => ParameterType::INTEGER]
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
            return $this->factory->createFromRowResult($this->rowValidator->validate($row));
        }
        catch (RowValidatorException $e) {
            throw new CategoryRepositoryException('', $e);
        }
    }
}
