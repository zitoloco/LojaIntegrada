<?php

namespace WSW\LojaIntegrada\Resources;

/**
 * Class Railings
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Railings extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/grades';


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
