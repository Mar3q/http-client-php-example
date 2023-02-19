<?php

namespace Mar3q\HttpClientPhpExample\Tests\Unit\Client;

use Mar3q\HttpClientPhpExample\Client\Client;
use Mar3q\HttpClientPhpExample\Exception\ClientException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientThrowValidException(): void
    {
        $client = new Client();
        $this->expectException(ClientException::class);

        $client->get('http://test123');
    }
}