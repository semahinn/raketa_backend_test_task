<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

interface CategoryInterface
{
    public function getId(): ?int;

    public function getName(): string;

    public function setName(string $name): static;
}