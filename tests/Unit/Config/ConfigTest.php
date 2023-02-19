<?php

namespace Mar3q\HttpClientPhpExample\Tests\Unit\Config;

use Mar3q\HttpClientPhpExample\Request\Config;
use Mar3q\HttpClientPhpExample\Request\CurlOption;
use Mar3q\HttpClientPhpExample\Request\Header;
use Mar3q\HttpClientPhpExample\Tests\Functional\TestEnvironment;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testCreateConfigOptions(): void
    {
        $config = (new Config())->addOption(new CurlOption(CURLOPT_PROXY, TestEnvironment::PROXY));

        $this->assertEquals($config->getCurlOptions()[0]->getOption(), CURLOPT_PROXY);
    }

    public function testCreteConfigHeaders(): void
    {
        $config = (new Config())->addHeader(new Header('Content-Type', 'application/json'));

        $this->assertEquals($config->getHeaders()[0]->getKey(), 'Content-Type');
    }
}