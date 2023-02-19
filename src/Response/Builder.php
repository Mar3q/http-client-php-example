<?php

namespace Mar3q\HttpClientPhpExample\Response;

use CurlHandlel;
use Mar3q\HttpClientPhpExample\Util\Utils;

class Builder
{
    /**
     * @param CurlHandlel $curlHandle
     * @param $result
     * @return Response
     */
    public static function build($curlHandle, $result): Response
    {
        $headerSize = curl_getinfo($curlHandle, CURLINFO_HEADER_SIZE);
        $headerStr = substr($result, 0, $headerSize);
        $bodyStr = substr($result, $headerSize);

        $headers = [];
        foreach(Utils::headersToArray($headerStr) as $key => $value) {
            $headers[$key] = $value;
        }

        $curlInfo = curl_getinfo($curlHandle);

        $response = new Response(
            (int)$curlInfo['http_code'],
            Utils::streamFor($bodyStr),
            $headers
        );

        return $response;
    }
}