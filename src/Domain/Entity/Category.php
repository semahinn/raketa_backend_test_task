<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

class Category implements CategoryInterface
{
    public function __construct(
        protected readonly ?int $id,
        protected string $name,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
       return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }
}