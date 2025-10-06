<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Connector\Facade;

use Raketa\BackendTestTask\Infrastructure\Connector\Connector\RedisConnector;
use Redis;
use RedisException;

class RedisConnectorFacade implements ConnectorFacadeInterface
{
    protected string $host = 'localhost';
    protected int $port = 6379;
    protected ?string $password = null;
    protected ?int $dbIndex = null;
    protected RedisConnector $connector;

    public function __construct(array $options) {
        $this->validateOptions($options);
        $this->host = $options['host'];
        $this->port = $options['port'];
        $this->password = $options['password'];
        $this->dbIndex = $options['db_index'];
        $this->build();
    }

    public function getConnector(): RedisConnector
    {
        return $this->connector;
    }

    protected function validateOptions(array $options): void
    {
        // TODO: Валидация наличия параметров и их значений
    }

    protected function build(): void
    {
        $redis = new Redis();

        try {
            $isConnected = $redis->isConnected();
            if (!$isConnected && $redis->ping('Pong')) {
                $isConnected = $redis->connect(
                    $this->host,
                    $this->port,
                );
            }
        } catch (RedisException) {
        }

        if ($isConnected) {
            $redis->auth($this->password);
            $redis->select($this->dbIndex);
            $this->connector = new RedisConnector($redis);
        }
    }
}
