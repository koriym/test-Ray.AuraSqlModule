<?php

namespace MyVendor\MyProject\Resource\Page;

class NamedPdoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BEAR\Resource\ResourceInterface
     */
    private $resource;

    protected function setUp()
    {
        parent::setUp();
        $this->resource = clone $GLOBALS['RESOURCE'];
    }

    public function testMaster()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $page = $this->resource->get->uri('page://self/named-pdo')->eager->request();
        /* @var $page NamedPdo */
        $this->assertSame(200, $page->code);
        $this->assertSame('mysql:host=localhost;dbname=master', $page->dsn);
    }

    public function testSlave()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $page = $this->resource->get->uri('page://self/named-pdo')->eager->request();
        /* @var $page NamedPdo */
        $this->assertSame(200, $page->code);
        $this->assertSame('mysql:host=localhost;dbname=slave', $page->dsn);
    }
}
