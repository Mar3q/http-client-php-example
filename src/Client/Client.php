<?php

namespace Mar3q\HttpClient\Client;

use Mar3q\HttpClient\Exception\ClientException;
use Mar3q\HttpClient\Handler\CurlHandler;
use Mar3q\HttpClient\Request\Builder;
use Mar3q\HttpClient\Request\Config;
use Mar3q\HttpClient\Response\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

class Client implements ClientInterface
{
    private Config $config;

    public function __construct(?Config $config = null)
    {
        $this->config = $config ?? new Config();
    }

    public function get(string $uri, array $params = [], ?Config $config = null)
    {
        return $this->request('GET', $uri, $params, $config);
    }

    public function post(string $uri, array $params, $payload, ?Config $config = null)
    {
        return $this->request('POST', $uri, $params, $payload, $config);
    }

    public function put(string $uri, array $params, $payload, ?Config $config = null)
    {
        return $this->request('PUT', $uri, $params, $payload, $config);
    }

    public function delete(string $uri, array $params = [], ?Config $config = null)
    {
        return $this->request('DELETE', $uri, $params, null, $config);
    }

    public function request(string $method, string $uri, array $params, $payload = null, ?Config $config = null): Response
    {
        return $this->sendRequest(Builder::build($method, $uri, $params, $payload, $this->config->merge($config)));
    }

    public function sendRequest(RequestInterface $request): Response
    {
        try {
            return (new CurlHandler())->handle($request);
        } catch(\Exception $exception) {
            throw ClientException::fromThrowable($exception);
        }
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}