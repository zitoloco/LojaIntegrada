<?php

namespace WSW\LojaIntegrada\Resources;

/**
 * Class Order
 *
 * @package WSW\LojaIntegrada\Resources
 * @author  Andre Ribas <ribas.andre@gmail.com>
 */
class Order extends BaseResource
{
    /**
     * @var string
     */
    protected $endPoint = '/v1/pedido';

    /**
     * @param  $id
     * @return object
     */
    public function findByStatus($id)
    {
        $endpoint = sprintf('%s/search/?situacao_id=%d', $this->endPoint, $id);

        return $this->__find($endpoint);
    }
}
