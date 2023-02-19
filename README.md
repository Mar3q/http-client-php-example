# http-client-php-example

### Install package :

```bash
composer require mar3q/http-client-php-example
composer install
```


### How to use client by examples :

```php
$client = new Client();
$client->get('https://localhost', ['param' => 'value'])
$data = $response->getData();
```

### How to customize client :
```php
//create config
$config = new Config();
//add header
$config->addHeader(new Header('Content-Type', 'application/json'));
//add curl option
$config->addOption(new CurlOption(CURLOPT_TIMEOUT, 1));

//you can pass config to client instance, will be applied for every request
$client = new Client($config);
$client->get('https://localhost', ['param' => 'value'])
$data = $response->getData();

//or you can pass config to single request
$client = new Client();
$client->get('https://localhost', ['param' => 'value'], $config)
$data = $response->getData();
```

### How to JWT auth example:
```php
$client = new Client((new Config())->setBaseUri('https://localhost'));

$response = $client->post('/api/login', ['param' => 'value'], json_encode([
    'username' => 'username',
    'password' => 'password'
]));

$data = $response->getData();

$client->getConfig()->setJWTToken($data['token']);
```