<?php

namespace WSW\LojaIntegrada;

use WSW\LojaIntegrada\Environments\Production;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    private $environment;

    protected function setUp()
    {
        $this->environment = $this->getMockForAbstractClass(Environment::class);

        $this->environment->expects($this->any())->method('getHost')->willReturn('test.com');
        $this->environment->expects($this->any())->method('getWsHost')->willReturn('ws.test.com');
    }

    public function isValidShouldReturnTrueWhenHostIsProduction()
    {
        $this->assertTrue(Environment::isValid(Production::WS_HOST));
    }

    /**
     * @test
     */
    public function isValidShouldReturnFalseWhenHostNotProduction()
    {
        $this->assertFalse(Environment::isValid('example.org'));
    }


    /**
     * @test
     */
    public function getWsUrlShouldAppendProtocolAndWsHostToResource()
    {
        $this->assertEquals('https://ws.test.com/test', $this->environment->getWsUrl('/test'));
    }


    /**
     * @test
     */
    public function getUrlShouldAppendProtocolAndHostToResource()
    {
        $this->assertEquals('https://test.com/test', $this->environment->getUrl('/test'));
    }
}
