<?php

namespace WSW\LojaIntegrada\Environments;

use \WSW\LojaIntegrada\Environment;

/**
 * Class Sandbox
 * @package WSW\LojaIntegrada\Environments
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Sandbox extends Environment
{

    const HOST = 'lojaintegrada.com.br';

    const WS_HOST = 'private-anon-0c3f98a96-lojaintegrada.apiary-mock.com';


    /**
     * @return string
     */
    public function getHost()
    {
        return self::HOST;
    }


    /**
     * @return string
     */
    public function getWsHost()
    {
        return self::WS_HOST;
    }
}
