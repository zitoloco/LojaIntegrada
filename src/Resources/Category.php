<?php

namespace WSW\LojaIntegrada\Resources;

/**
 * Class Category
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Category extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/categoria';

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
