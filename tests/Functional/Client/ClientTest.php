<?php

namespace Mar3q\HttpClient\Tests\Functional\Client;

use Mar3q\HttpClient\Client\Client;
use Mar3q\HttpClient\Request\Config;
use Mar3q\HttpClient\Request\CurlOption;
use Mar3q\HttpClient\Request\Header;
use Mar3q\HttpClient\Tests\Functional\TestEnvironment;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private function getDefaultConfig(): Config
    {
        return (new Config())
            ->setBaseUri(TestEnvironment::BASE_URI)
            ->addOption(new CurlOption(CURLOPT_PROXY, TestEnvironment::PROXY))
            ->addHeader(new Header('Content-Type', 'application/json'));
    }

    /**
     * @param Client $client
     * @return Client
     */
    private function loginClientToApi(Client $client): Client
    {
        $response = $client->post('/api/login_check', [], json_encode([
            "username" => TestEnvironment::JWT_USER,
            "password" => TestEnvironment::JWT_PASS
        ]));

        $client->getConfig()->setJWTToken($response->getData()['token']);

        return $client;
    }

    public function testJwtAuth(): void
    {
        $config = $this->getDefaultConfig();
        $client = new Client($config);

        $client = $this->loginClientToApi($client);

        $response = $client->get('/api');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testClientCanRequestPost()
    {
        $client = new Client($this->getDefaultConfig());

        $client = $this->loginClientToApi($client);

        $response = $client->post('/api', ['param' => 'paramValue'], json_encode(['test']));

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testClientCanRequestPut()
    {
        $client = new Client($this->getDefaultConfig());

        $client = $this->loginClientToApi($client);

        $response = $client->put('/api', ['param' => 'paramValue'], json_encode(['test']));

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testClientCanRequestDelete()
    {
        $client = new Client($this->getDefaultConfig());

        $client = $this->loginClientToApi($client);

        $response = $client->delete('/api');

        $this->assertEquals(200, $response->getStatusCode());
    }
}