<?php

namespace Mar3q\HttpClient\Tests\Unit\Client;

use Mar3q\HttpClient\Client\Client;
use Mar3q\HttpClient\Exception\ClientException;
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