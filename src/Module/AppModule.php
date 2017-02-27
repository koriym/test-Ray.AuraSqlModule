<?php

namespace MyVendor\MyProject\Module;

use Aura\Sql\ConnectionLocator;
use BEAR\Package\PackageModule;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\AuraSqlModule\AuraSqlReplicationModule;
use Ray\AuraSqlModule\Connection;
use Ray\Di\AbstractModule;
use josegonzalez\Dotenv\Loader as Dotenv;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        Dotenv::load([
            'filepath' => dirname(dirname(__DIR__)) . '/.env',
            'toEnv' => true
        ]);
        $this->install(new PackageModule);

        $this->install(new AuraSqlModule('mysql:host=localhost;dbname=default'));
        $locator = new ConnectionLocator();
        $locator->setWrite('master', new Connection('mysql:host=localhost;dbname=master', 'root', ''));
        $locator->setRead('slave1',  new Connection('mysql:host=localhost;dbname=slave', 'root', ''));
        $this->install(new AuraSqlReplicationModule($locator));
        $this->install(new AuraSqlReplicationModule($locator, 'foo'));
    }
}
