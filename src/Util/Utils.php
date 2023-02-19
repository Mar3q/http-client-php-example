<?php

namespace Mar3q\HttpClientPhpExample\Util;

use Psr\Http\Message\StreamInterface;

class Utils
{
    /**
     * @param string $str
     * @return array
     */
    public static function headersToArray(string $str): array
    {
        $headers = [];
        $headersTmpArray = explode("\r\n", $str);
        for($i = 0; $i < count($headersTmpArray); ++$i) {
            if(strlen($headersTmpArray[$i]) > 0) {
                if(strpos($headersTmpArray[$i], ":")) {
                    $headerName = substr($headersTmpArray[$i], 0, strpos($headersTmpArray[$i], ":"));
                    $headerValue = substr($headersTmpArray[$i], strpos($headersTmpArray[$i], ":") + 1);
                    $headers[$headerName] = trim($headerValue);
                }
            }
        }
        return $headers;
    }


    /**
     * @param $data
     * @return StreamInterface
     */
    public static function streamFor($data): StreamInterface
    {
        return \GuzzleHttp\Psr7\Utils::streamFor($data);
    }
}