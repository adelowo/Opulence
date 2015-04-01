<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Mocks the console application for use in testing
 */
namespace RDev\Tests\Framework\Tests\Console\Mocks;
use Monolog\Logger;
use RDev\Applications\Application;
use RDev\Applications\Paths;
use RDev\Applications\Environments\Environment;
use RDev\Framework\Tests\Console\ApplicationTestCase as BaseApplicationTestCase;
use RDev\IoC\Container;
use RDev\Sessions\Session;
use RDev\Tests\Applications\Mocks\MonologHandler;

class ApplicationTestCase extends BaseApplicationTestCase
{
    /** @var array The list of bootstrapper classes to include */
    private static $bootstrappers = [
        "RDev\\Framework\\Bootstrappers\\HTTP\\Views\\Template",
        "RDev\\Framework\\Bootstrappers\\Console\\Commands\\Commands",
        "RDev\\Framework\\Bootstrappers\\Console\\Composer\\Composer",
    ];

    /**
     * {@inheritdoc}
     */
    protected function setApplication()
    {
        // Create and bind all of the components of our application
        $paths = new Paths([
            "configs" => __DIR__ . "/../../configs"
        ]);
        $logger = new Logger("application");
        $logger->pushHandler(new MonologHandler());
        $environment = new Environment(Environment::TESTING);
        $container = new Container();
        $session = new Session();
        $container->bind("RDev\\Applications\\Paths", $paths);
        $container->bind("Monolog\\Logger", $logger);
        $container->bind("RDev\\Applications\\Environments\\Environment", $environment);
        $container->bind("RDev\\IoC\\IContainer", $container);
        $container->bind("RDev\\Sessions\\ISession", $session);

        // Actually set the application
        $this->application = new Application($paths, $logger, $environment, $container, $session);
        $this->application->registerBootstrappers(self::$bootstrappers);
    }
}