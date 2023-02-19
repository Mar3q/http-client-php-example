<?php

namespace Mar3q\HttpClient\Request;

use GuzzleHttp\Psr7\Utils;

class Builder
{

    /**
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param $payload
     * @param Config $config
     * @return Request
     */
    public static function build(string $method, string $uri, array $params, $payload, Config $config): Request
    {
        if(!empty($baseUri = $config->getBaseUri())) {
            $uri = sprintf('%s%s', $baseUri, $uri);
        }

        if(!empty($params)) {
            $uri = sprintf('%s?%s', $uri, http_build_query($params));
        }

        return new Request($method, $uri, $payload, $config);
    }
}