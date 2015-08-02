<?php

namespace Tests\UnitTest\Services;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public $container;

    public function setUp()
    {
        $this->container = new \Ilpaijin\Services\Container;

        $this->container->set('foo', 'bar');
    }

    public function tearDown()
    {
        $this->container = null;
    }

    public function testItAddsStuffToContainer()
    {
        $this->assertTrue($this->container->get('foo') === 'bar');
    }
}
