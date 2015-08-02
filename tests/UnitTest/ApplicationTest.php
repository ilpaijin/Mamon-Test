<?php

namespace Tests\UnitTest;

use Ilpaijin\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $containerMock = $this->getMockBuilder('Ilpaijin\\Services\\Container')
            ->setMethods(array('get', 'set'))
            ->getMock();

        $containerMock->method('get')
            ->willReturn('bar');

        $this->app = new Application($containerMock);
    }

    public function tearDown()
    {
        $this->app = null;
    }

    public function testItProxiesContainerGetCalls()
    {
        $this->assertTrue($this->app->getContainer()->get('foo') === 'bar');
    }
}
