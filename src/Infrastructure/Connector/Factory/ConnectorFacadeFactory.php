<?php

namespace Raketa\BackendTestTask\Infrastructure\Connector\Factory;

use Raketa\BackendTestTask\Infrastructure\Connector\Facade\ConnectorFacadeInterface;

class ConnectorFacadeFactory implements ConnectorFacadeFactoryInterface {

    public function create(string $realConnectorFacadeClass, array $options = []): ConnectorFacadeInterface
    {
        return new $realConnectorFacadeClass($options);
    }
}