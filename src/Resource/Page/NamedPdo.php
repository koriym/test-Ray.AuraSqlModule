<?php

namespace MyVendor\MyProject\Resource\Page;

use Aura\Sql\ExtendedPdoInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Named;

class NamedPdo extends ResourceObject
{
    public $dsn;

    /**
     * @Named("pdo=foo")
     */
    public function __construct(ExtendedPdoInterface $pdo)
    {
        $this->dsn = $pdo->getDsn();
    }

    public function onGet()
    {
        return $this;
    }
}
