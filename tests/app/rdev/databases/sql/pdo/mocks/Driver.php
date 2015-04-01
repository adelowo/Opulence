<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Mocks the PDO driver for use in testing
 */
namespace RDev\Tests\Databases\SQL\PDO\Mocks;
use RDev\Databases\SQL\Server;
use RDev\Databases\SQL\PDO\Driver as BaseDriver;
use RDev\Databases\SQL\Providers\Provider;

class Driver extends BaseDriver
{
    /**
     * {@inheritdoc}
     */
    protected function getDSN(Server $server, array $options = [])
    {
        return "fakedsn";
    }

    /**
     * {@inheritdoc}
     */
    protected function setProvider()
    {
        $this->provider = new Provider();
    }
} 