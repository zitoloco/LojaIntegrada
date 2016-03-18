<?php

namespace WSW\LojaIntegrada;

use WSW\LojaIntegrada\Environments\Production;

/**
 * Class Credentials
 * @package WSW\LojaIntegrada
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Credentials
{
    /**
     * @var
     */
    private $chaveApi;

    /**
     * @var
     */
    private $aplicacao;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * @param $chaveApi
     * @param $aplicacao
     * @param Environment|null $environment
     */
    public function __construct($chaveApi, $aplicacao, Environment $environment = null)
    {
        $this->setChaveApi($chaveApi);
        $this->setAplicacao($aplicacao);

        $this->environment = $environment ?: new Production();
    }

    /**
     * @param $chaveApi
     * @return $this
     */
    public function setChaveApi($chaveApi)
    {
        $this->chaveApi = substr($chaveApi, 0, 36);
        return $this;
    }


    /**
     * @param $aplicacao
     * @return $this
     */
    public function setAplicacao($aplicacao)
    {
        $this->aplicacao = substr($aplicacao, 0, 36);
        return $this;
    }


    /**
     * @return string
     */
    public function getChaveApi()
    {
        return $this->chaveApi;
    }

    /**
     * @return string
     */
    public function getAplicacao()
    {
        return $this->aplicacao;
    }

    /**
     * @param $resource
     * @return string
     */
    public function getUrl($resource)
    {
        return $this->environment->getUrl($resource);
    }

    /**
     * @param $resource
     * @return string
     */
    public function getWsUrl($resource, array $params = [])
    {
        $resource = '/' . ltrim($resource, '/');

        if (empty($params)) {
            return $this->environment->getWsUrl($resource);

        }

        return sprintf(
            '%s?%s',
            $this->environment->getWsUrl($resource),
            http_build_query($params)
        );
    }
}
