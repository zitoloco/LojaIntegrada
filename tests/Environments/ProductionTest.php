<?php

namespace WSW\LojaIntegrada\Environments;

class ProductionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testGetHostShouldReturnTheConstantValue()
    {
        $env = new Production();
        $this->assertEquals(Production::HOST, $env->getHost());
    }

    /**
     * @test
     */
    public function testGetWsHostShouldReturnTheConstantValue()
    {
        $env = new Production();
        $this->assertEquals(Production::WS_HOST, $env->getWsHost());
    }
}
