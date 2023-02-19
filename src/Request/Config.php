<?php

namespace Mar3q\HttpClientPhpExample\Request;

/**
 * Request custom options
 */
class Config
{
    /**
     * @var CurlOption[]
     */
    private array $curlOptions = [];

    /**
     * @var Header[]
     */
    private array $headers = [];

    /**
     * @var string
     */
    private string $baseUri = '';

    public function __construct()
    {
    }

    public function hasHeaders(): bool
    {
        return count($this->getHeaders()) > 0;
    }

    /**
     * @return Header[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeadersAsString(): array
    {
        $arr = [];

        foreach($this->getHeaders() as $header) {
            $arr[] = (string)$header;
        }

        return $arr;
    }

    /**
     * @param Header $header
     * @return Config
     */
    public function addHeader(Header $header): self
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * @param string $token
     * @return void
     */
    public function setJWTToken(string $token): void
    {
        $this->addHeader(new Header('Authorization', sprintf('Bearer %s', $token)));
    }


    public function addOption(CurlOption $option): self
    {
        $this->curlOptions[] = $option;

        return $this;
    }

    /**
     * @return CurlOption[]
     */
    public function getCurlOptions(): array
    {
        return $this->curlOptions;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     * @return Config
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    public function merge(?Config $config = null): self
    {
        if($config === null) {
            return $this;
        }

        foreach($config->getHeaders() as $header) {
            $this->addHeader($header);
        }

        foreach($config->getCurlOptions() as $option) {
            $this->addOption($option);
        }


        return $this;
    }
}