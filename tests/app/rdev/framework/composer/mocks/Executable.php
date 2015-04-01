<?php
/**
 * Copyright (C) 2015 David Young
 * 
 * Mocks the Composer executable for use in testing
 */
namespace RDev\Tests\Framework\Composer\Mocks;
use RDev\Framework\Composer\Executable as BaseExecutable;

class Executable extends BaseExecutable
{
    /**
     * {@inheritdoc}
     * @return string The command itself
     */
    protected function execute($command)
    {
        return $command;
    }
}