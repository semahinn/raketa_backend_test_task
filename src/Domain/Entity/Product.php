<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain\Entity;

class Product implements ProductInterface
{
    public function __construct(
        protected readonly ?int $id,
        protected readonly string $uuid,
        protected bool $isActive,
        protected CategoryInterface $category,
        protected string $name,
        protected string $description,
        protected string $thumbnail,
        protected float $price,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setActive(bool $is_active): static
    {
        $this->isActive = $is_active;
        return $this;
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }

    public function setCategory(CategoryInterface $category): static
    {
        $this->category = $category;
        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }
}
