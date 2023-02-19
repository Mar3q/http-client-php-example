<?php

namespace Mar3q\HttpClient\Request;

class Request extends \GuzzleHttp\Psr7\Request
{
    private string $uri;

    private string $method;

    private Config $config;

    /**
     * @var mixed
     */
    private $payload;

    /**
     * @param string $uri
     * @param string $method
     */
    public function __construct(
        string  $method,
        string  $uri,
                $payload,
        ?Config $config = null,
        string  $version = '1.1'
    )
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->config = $config ?? new Config();
        $this->payload = $payload;

        parent::__construct(
            $method,
            $uri,
            $this->config->getHeadersAsString(),
            $payload,
            $version
        );
    }

    public function isPost(): bool
    {
        return strtoupper($this->method) === 'POST';
    }

    public function isPut(): bool
    {
        return strtoupper($this->method) === 'PUT';
    }

    public function isDelete(): bool
    {
        return strtoupper($this->method) === 'DELETE';
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}