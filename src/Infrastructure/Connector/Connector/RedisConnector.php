<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Connector\Connector;

use Raketa\BackendTestTask\Infrastructure\Connector\Exception\ConnectorException;
use Redis;
use RedisException;

class RedisConnector implements ConnectorInterface
{
    public function __construct(protected Redis $redis) {
    }

    public function get(string $key)
    {
        try {
            return unserialize($this->redis->get($key));
        } catch (RedisException $e) {
            throw new ConnectorException('Connector error', 500, $e);
        }
    }

    public function set(string $key, mixed $value, int $ttl = 60): void
    {
        try {
            $this->redis->setex($key, $ttl, serialize($value));
        } catch (RedisException $e) {
            throw new ConnectorException('Connector error', 500, $e);
        }
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }
}
