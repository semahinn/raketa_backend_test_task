<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

interface ProductInterface
{
    public function getId(): ?int;

    public function getUuid(): string;

    public function isActive(): bool;

    public function setActive(bool $is_active): static;

    public function getCategory(): CategoryInterface;

    public function setCategory(CategoryInterface $category): static;

    public function getName(): string;

    public function setName(string $name): static;

    public function getDescription(): ?string;

    public function setDescription(string $description): static;

    public function getThumbnail(): ?string;

    public function setThumbnail(string $thumbnail): static;

    public function getPrice(): float;

    public function setPrice(float $price): static;
}