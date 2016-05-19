<?php

namespace WSW\LojaIntegrada\Resources;

use WSW\LojaIntegrada\Credentials;
use WSW\LojaIntegrada\Client\Client;
use WSW\LojaIntegrada\Client\LojaIntegradaException;
use Cake\Validation\Validator;

/**
 * Class BaseResource
 * @package WSW\LojaIntegrada\Resources
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
abstract class BaseResource
{
    /**
     * @var
     */
    protected $endPoint;
    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var Client
     */
    protected $client;

    protected $validator;

    /**
     * @var array
     */
    protected $fieldsDefault = [];


    /**
     * @param Credentials $credentials
     * @param Client|null $client
     */
    public function __construct(Credentials $credentials, Client $client = null, Validator $validator = null)
    {
        $this->credentials = $credentials;
        $this->client      = $client ?: new Client();
        $this->validator   = $validator ?: new Validator();

        $this->client->setHeader(
            'Authorization',
            sprintf(
                'chave_api %s aplicacao %s',
                $this->credentials->getChaveApi(),
                $this->credentials->getAplicacao()
            )
        );

        $this->__setUp();
    }


    /**
     * @return $this
     */
    protected function __setUp()
    {
    }


    /**
     * @return $this
     */
    public function idExternal()
    {
        $this->setFieldDefault('id_externo', 1);
        return $this;
    }


    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit = 20)
    {
        $this->setFieldDefault('limit', (int) $limit);
        return $this;
    }


    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset = 20)
    {
        $this->setFieldDefault('offset', (int) $offset);
        return $this;
    }


    /**
     * @param $key
     * @param $value
     */
    protected function setFieldDefault($key, $value)
    {
        $this->fieldsDefault[$key] = $value;
    }


    /**
     * @param null $key
     * @return array|bool
     */
    protected function getFieldDefault($key = null)
    {
        if (!is_null($key)) {
            return (isset($this->fieldsDefault[$key])) ? $this->fieldsDefault[$key] : false;
        }

        return $this->fieldsDefault;
    }


    /**
     * @return object
     */
    public function findAll()
    {
        if ($this->getFieldDefault('id_externo') !== false) {
            throw new LojaIntegradaException('external id is not allowed in findall', 1);
        }

        return $this->__find($this->endPoint);
    }


    /**
     * @param $id
     * @return object
     */
    public function find($id)
    {
        $endpoint = sprintf('%s/%d', $this->endPoint, $id);

        if (is_array($id)) {
            $endpoint = sprintf('%s/set/%s', $this->endPoint, implode(';', $id));
        }

        return $this->__find($endpoint);
    }


    /**
     * @param int $id
     * @return bool
     */
    public function exists($id)
    {
        try {
            $this->find($id);
            return true;
        } catch (LojaIntegradaException $e) {
            return false;
        }
    }
    

    /**
     * @param null $endpoint
     * @return object
     */
    protected function __find($endpoint = null)
    {
        $url = $this->credentials->getWsUrl($endpoint, $this->getFieldDefault());
        $this->reset();

        return $this->client->get($url);
    }

    /**
     * @param array $fields
     * @return object
     */
    public function save(array $fields)
    {
        $erros = $this->validator->errors($fields);

        if (!empty($erros)) {
            $this->__treatErrors($erros);
        }

        $url = $this->credentials->getWsUrl($this->endPoint);
        $this->reset();

        return $this->client->post($url, $fields);
    }


    public function update($id, array $fields)
    {
        $endpoint = sprintf('%s/%d', $this->endPoint, $id);

        $erros = $this->validator->errors($fields);

        if (!empty($erros)) {
            $this->__treatErrors($erros);
        }

        $url = $this->credentials->getWsUrl($endpoint, $this->getFieldDefault());
        $this->reset();

        return $this->client->put($url, $fields);
    }


    /**
     * @param array $erros
     * @exception \InvalidArgumentException
     */
    private function __treatErrors(array $erros)
    {
        $outputErr = 'Some errors occurred:';

        foreach ($erros as $field => $message) {
            $outputErr .= PHP_EOL . '[' . $field . '] ' . implode('', $message);
        }

        throw new \InvalidArgumentException($outputErr);
    }


    /**
     * reset
     */
    protected function reset()
    {
        $this->fieldsDefault = [];
    }
}
