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
     * @return \Psr\Http\Message\StreamInterface
     */
    public function get($url)
    {
        try {
            $response = $this->client->get($url, [
                'headers' => $this->getHeader()
            ]);

            return $response->getBody();

        } catch (ClientException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (ServerException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }


    /**
     * @param $url
     * @param array $fields
     * @exception LojaIntegradaException
     * @return object
     */
    public function post($url, array $fields)
    {
        try {
            $response = $this->client->post($url, [
                'headers' => $this->getHeader(),
                'body' => json_encode($fields)
            ]);

            return json_decode($response->getBody()->getContents());

        } catch (ClientException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (ServerException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }


    /**
     * @param $url
     * @param array $fields
     * @exception LojaIntegradaException
     * @return object
     */
    public function put($url, array $fields)
    {
        try {
            $response = $this->client->put($url, [
                'headers' => $this->getHeader(),
                'body' => json_encode($fields)
            ]);

            return json_decode($response->getBody()->getContents());

        } catch (ClientException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        } catch (ServerException $e) {
            throw new LojaIntegradaException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
