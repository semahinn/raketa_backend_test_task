<?php

namespace Raketa\BackendTestTask\Infrastructure\Row\RowValidator;

use Raketa\BackendTestTask\Domain\Row\Exception\RowValidatorException;
use Raketa\BackendTestTask\Domain\Row\RowResult\CategoryRowResult;
use Raketa\BackendTestTask\Domain\Row\RowValidator\CategoryRowValidatorInterface;

class CategoryRowValidator implements CategoryRowValidatorInterface {

    public function validate(array $row): CategoryRowResult
    {
        try {
            $rawResult = CategoryRowResult::fromRow($row);
        }
        catch (\TypeError $e) {
            throw new RowValidatorException("Получены некорректные данные о записи категории товаров из базы данных", $e);
        }

        // Здесь должна быть валидация экземпляра $rawResult. Например, можно использовать symfony/validator.
        // Тогда мы сможем проверить, опираясь на ограничения, прикреплённые к свойствам класса CategoryRowResult
        // ...
        // throw new RowValidatorException("Значение свойства '$property' не прошло проверку");

        return $rawResult;
    }
}