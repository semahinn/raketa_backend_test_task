<?php

namespace Raketa\BackendTestTask\Infrastructure\Connector\Facade;

use Raketa\BackendTestTask\Infrastructure\Connector\Connector\ConnectorInterface;

interface ConnectorFacadeInterface {

    public function getConnector(): ConnectorInterface;

}