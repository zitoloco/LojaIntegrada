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
    const PEDIDO_CANCELADO            = 8;
    const PEDIDO_EFETUADO             = 9;
    const PEDIDO_ENTREGUE             = 14;
    const PEDIDO_ENVIADO              = 11;
    const PEDIDO_PAGO                 = 4;
    const PEDIDO_EM_PRODUCAO          = 17;
    const PEDIDO_EM_SEPARACAO         = 15;
    const PEDIDO_PRONTO_PARA_RETIRADA = 13;
    const PEDIDO_AGUARDANDO_PAGAMENTO = 2;
    const PAGAMENTO_DEVOLVIDO         = 7;
    const PAGAMENTO_EM_ANALISE        = 3;
    const PAGAMENTO_EM_CHARGEBACK     = 16;
    const PAGAMENTO_EM_DISPUTA        = 6;

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

    /**
     * @param  $id
     * @return object
     */
    public function updateStatus($id, $status_code)
    {
        $this->endPoint = 'v1/situacao/pedido';

        $fields = [
            'codigo' => $status_code,
        ];

        return $this->update($id, $fields);
    }

    public function updateTracking($id, $tracking)
    {
        $this->endPoint = sprintf('v1/pedido_envio', $id);

        $fields = [
            'objeto' => $tracking,
        ];

        return $this->update($id, $fields);
    }
}
