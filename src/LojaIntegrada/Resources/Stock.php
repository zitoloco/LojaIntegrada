<?php

namespace WSW\LojaIntegrada\Resources;

use WSW\LojaIntegrada\Client\LojaIntegradaException;

/**
 * Class Stock
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Stock extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/produto_estoque';


    /**
     * @param array $fields
     * @exception LojaIntegradaException
     */
    public function save(array $fields = [])
    {
        throw new LojaIntegradaException('Feature not supported by API');
    }
}
