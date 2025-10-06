<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

class Customer implements CustomerInterface
{
    public function __construct(
        protected readonly ?int $id,
        protected string $firstName,
        protected string $lastName,
        protected string $middleName,
        protected string $email,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
