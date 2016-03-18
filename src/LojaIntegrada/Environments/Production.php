<?php

namespace WSW\LojaIntegrada\Environments;

use \WSW\LojaIntegrada\Environment;

/**
 * Class Production
 * @package WSW\LojaIntegrada\Environments
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Production extends Environment
{

    const HOST = 'lojaintegrada.com.br';

    const WS_HOST = 'api.awsli.com.br';


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
