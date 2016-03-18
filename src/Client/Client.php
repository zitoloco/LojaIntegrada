<?php

namespace WSW\LojaIntegrada\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**
 * Class Client
 * @package WSW\LojaIntegrada\Client
 * @author Ronaldo Matos Rodrigues <ronaldo@whera.com.br>
 */
class Client
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    public static $allowedMethods = ['get', 'post', 'put'];

    /**
     * @param HttpClient|null $client
     */
    public function __construct(HttpClient $client = null)
    {
        $this->client = $client ?: new HttpClient();
        $this->setHeader('Content-Type', 'application/json');
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->headers;
    }


    /**
     * @param $url
     * @return object
     */
    public function get($url)
    {
        return $this->__request('get', $url);
    }


    /**
     * @param $url
     * @param array $fields
     * @return object
     */
    public function post($url, array $fields)
    {
        return $this->__request('post', $url, $fields);
    }


    /**
     * @param $url
     * @param array $fields
     * @return object
     */
    public function put($url, array $fields)
    {
        return $this->__request('put', $url, $fields);
    }


    /**
     * @param string $method
     * @param $url
     * @param array $fields
     * @exception LojaIntegradaException
     * @return object
     */
    private function __request($method = 'get', $url = false, array $fields = [])
    {
        $params = [];
        $method = mb_strtolower($method);

        if (!in_array($method, self::$allowedMethods)) {
            throw new LojaIntegradaException('Method not allowed by the system', 500);
        }

        if (!empty($fields)) {
            $params['body'] = json_encode($fields);
        }
        $params['headers'] = $this->getHeader();

        try {
            $response = $this->client->{$method}($url, $params);

            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (ServerException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
