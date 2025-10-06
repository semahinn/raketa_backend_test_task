<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Connector\Connector;

use Raketa\BackendTestTask\Infrastructure\Connector\Exception\ConnectorException;

interface ConnectorInterface {

    /**
     * @throws ConnectorException
     */
    public function get(string $key);

    /**
     * @throws ConnectorException
     */
    public function set(string $key, mixed $value, int $ttl = 60): void;

    public function has(string $key): bool;
}