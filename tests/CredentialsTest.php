<?php

namespace WSW\LojaIntegrada;

use WSW\LojaIntegrada\Environments\Production;

class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Environment
     */
    private $environment;

    protected function setUp()
    {
        $this->environment = $this->getMockForAbstractClass(Environment::class);

        $this->environment->expects($this->any())->method('getHost')->willReturn('test.com');
        $this->environment->expects($this->any())->method('getWsHost')->willReturn('ws.test.com');
    }

    public function testConstructShouldConfigureTheAttributes()
    {
        $credentials = new Credentials(
            '0a0000a0-aaa0-0000-a000-aa0a000000aa',
            '0a0000a0-aaa0-0000-a000-aa0a000000aB',
            $this->environment
        );

        $this->assertAttributeEquals('0a0000a0-aaa0-0000-a000-aa0a000000aa', 'chaveApi', $credentials);
        $this->assertAttributeEquals('0a0000a0-aaa0-0000-a000-aa0a000000aB', 'aplicacao', $credentials);

        $this->assertAttributeSame($this->environment, 'environment', $credentials);
    }

    public function testConstructShouldTruncateChaveapiAndAplicacao()
    {
        $credentials = new Credentials(
            str_repeat('a', 40),
            str_repeat('b', 40),
            $this->environment
        );

        $this->assertAttributeEquals(str_repeat('a', 36), 'chaveApi', $credentials);
        $this->assertAttributeEquals(str_repeat('b', 36), 'aplicacao', $credentials);
    }

    public function testMethodsShouldTruncateChaveapiAndAplicacao()
    {
        $credentials = new Credentials(
            str_repeat('a', 40),
            str_repeat('b', 40),
            $this->environment
        );

        $credentials->setChaveApi(str_repeat('c', 40));
        $credentials->setAplicacao(str_repeat('d', 40));

        $this->assertAttributeEquals(str_repeat('c', 36), 'chaveApi', $credentials);
        $this->assertAttributeEquals(str_repeat('d', 36), 'aplicacao', $credentials);
    }

    public function testMethodsGetsChaveapiAndAplicacao()
    {
        $credentials = new Credentials(
            str_repeat('a', 40),
            str_repeat('b', 40),
            $this->environment
        );

        $this->assertEquals(str_repeat('a', 36), $credentials->getChaveApi());
        $this->assertEquals(str_repeat('b', 36), $credentials->getAplicacao());

        $credentials->setChaveApi(str_repeat('c', 40));
        $credentials->setAplicacao(str_repeat('d', 40));

        $this->assertEquals(str_repeat('c', 36), $credentials->getChaveApi());
        $this->assertEquals(str_repeat('d', 36), $credentials->getAplicacao());
    }

    public function testConstructShouldUseProductionAsDefaultEnvironment()
    {
        $credentials = new Credentials(str_repeat('a', 36), str_repeat('b', 36));

        $this->assertAttributeInstanceOf(Production::class, 'environment', $credentials);
    }

    public function testGetUrlShouldGetTheWsUrlFromTheEnvironment()
    {
        $credentials = new Credentials(
            str_repeat('a', 36),
            str_repeat('b', 36),
            $this->environment
        );

        $this->assertEquals(
            'https://ws.test.com/v1/test',
            $credentials->getWsUrl('/v1/test')
        );

        $this->assertEquals(
            'https://ws.test.com/v1/test?id_externo=1',
            $credentials->getWsUrl('/v1/test', ['id_externo' => 1])
        );
    }

    public function testGetUrlShouldGetTheUrlFromTheEnvironment()
    {
        $credentials = new Credentials(
            str_repeat('a', 36),
            str_repeat('b', 36),
            $this->environment
        );

        $this->assertEquals(
            'https://test.com/v1/test',
            $credentials->getUrl('/v1/test')
        );
    }
}
