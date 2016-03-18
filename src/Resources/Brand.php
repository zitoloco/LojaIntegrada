<?php

namespace WSW\LojaIntegrada\Resources;

/**
 * Class Brand
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Brand extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/marca';

    /**
     * Setup
     */
    protected function __setUp()
    {
        $this->validator
            ->requirePresence('nome')
            ->notEmpty('nome', 'Required field');

    }
}
