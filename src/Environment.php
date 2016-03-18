<?php

namespace WSW\LojaIntegrada;

use \WSW\LojaIntegrada\Environments\Production;

/**
 * Class Environment
 * @package WSW\LojaIntegrada
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
abstract class Environment
{

    /**
     * @param $host
     * @return bool
     */
    public static function isValid($host)
    {
        return in_array($host, [Production::WS_HOST]);
    }


    /**
     * @param $resource
     * @return string
     */
    public function getWsUrl($resource)
    {
        return 'https://' . $this->getWsHost() . $resource;
    }


    /**
     * @param $resource
     * @return string
     */
    public function getUrl($resource)
    {
        return 'https://' . $this->getHost() . $resource;
    }


    /**
     * @return string
     */
    abstract public function getWsHost();


    /**
     * @return string
     */
    abstract public function getHost();
}
