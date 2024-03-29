<?php

namespace MyVendor\MyProject\Resource\Page;

use Aura\Sql\ExtendedPdoInterface;
use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public $dsn;

    public function __construct(ExtendedPdoInterface $pdo)
    {
        $this->dsn = $pdo->getDsn();
    }

    public function onGet()
    {
        return $this;
    }
}
