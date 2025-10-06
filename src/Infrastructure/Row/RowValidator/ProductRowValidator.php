<?php

namespace Raketa\BackendTestTask\Infrastructure\Row\RowValidator;

use Raketa\BackendTestTask\Domain\Exception\ProductRepositoryException;
use Raketa\BackendTestTask\Domain\Row\RowResult\ProductRowResult;
use Raketa\BackendTestTask\Domain\Row\RowValidator\ProductRowValidatorInterface;

class ProductRowValidator implements ProductRowValidatorInterface {

    public function validate(array $row): ProductRowResult
    {
        try {
            $rowResult = ProductRowResult::fromRow($row);
        }
        catch (\TypeError $e) {
            throw new ProductRepositoryException("Получены некорректные данные о товаре из базы данных", $e);
        }

        // Здесь должна быть валидация экземпляра $rowResult. Например, можно использовать symfony/validator.
        // Тогда мы сможем проверить, опираясь на ограничения, прикреплённые к свойствам класса ProductRowResult
        // ...
        // throw new RowValidatorException("Значение свойства '$property' не прошло проверку");

        return $rowResult;
    }
}