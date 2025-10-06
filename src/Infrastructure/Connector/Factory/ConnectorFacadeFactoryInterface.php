<?php

namespace Raketa\BackendTestTask\Infrastructure\Connector\Factory;

use Raketa\BackendTestTask\Infrastructure\Connector\Facade\ConnectorFacadeInterface;

interface ConnectorFacadeFactoryInterface {

    public function create(string $realConnectorFacadeClass, array $options = []): ConnectorFacadeInterface;

}