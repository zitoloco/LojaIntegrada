<?php

namespace WSW\LojaIntegrada\Resources;

/**
 * Class Price
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Price extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/produto_preco';

    /**
     * @param array $fields
     * @exception LojaIntegradaException
     */
    public function save(array $fields = [])
    {
        throw new LojaIntegradaException('Feature not supported by API');
    }
}
