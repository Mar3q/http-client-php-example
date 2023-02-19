<?php

namespace Mar3q\HttpClient\Response;

use Psr\Http\Message\StreamInterface;

class Response extends \GuzzleHttp\Psr7\Response
{
    /**
     * @param int $statusCode
     * @param StreamInterface $body
     * @param array $headers
     * @param string $version
     * @param string|null $reason
     */
    public function __construct(
        int             $statusCode,
        StreamInterface $body,
        array           $headers = [],
        string          $version = '1.1',
        string          $reason = null
    )
    {
        parent::__construct(
            $statusCode,
            $headers,
            $body,
            $version,
            $reason
        );
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return json_decode($this->getBody()->getContents(), true);
    }
}