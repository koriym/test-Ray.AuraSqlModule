<?php

namespace MyVendor\MyProject\Resource\Page;

class IndexTest extends \PHPUnit_Framework_TestCase
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
        $page = $this->resource->get->uri('page://self/index')->eager->request();
        /* @var $page NamedPdo */
        $this->assertSame(200, $page->code);
        $this->assertSame('mysql:host=localhost;dbname=default', $page->dsn);
    }
}
