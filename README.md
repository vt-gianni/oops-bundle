<p align="center">
  <img src="asset/logo.png" width="250" title="Logo" alt="Logo">
</p>

# About

Oops Bundle is a Symfony bundle allowing you to manage the error returns of your API calls.

# Install

## Requirements

:warning: Here are the requirements for using Oops Bundle:

```sh
php: >=7.4
doctrine/orm: >=2.13
symfony/framework-bundle: >=5.4
symfony/validator: >=4.4
symfony/http-client: >=4.4
```
## Get started

To get started with Oops Bundle, use Composer to add the package to your project's dependencies:

```sh
composer require vtgianni/oops-bundle
```

Then update your database schema with the following command:

```sh
php bin/console d:s:u --force
```

# How to use it

There are two ways to use Oops Bundle: automatic or manual error logging. 

## Automatic error logging

Oops Bundle provides a wrapper for HttpClient requests.

This allows you to make your API calls without worrying about errors as they will be automatically recorded in your database "oops" table.

Start by injecting OopsClient into your class:

```php
use VTGianni\OopsBundle\Service\OopsClient;

class MyService
{
    private $oopsClient;

    public function __construct(OopsClient $oopsClient)
    {
        $this->oopsClient = $oopsClient;
    }
}
```

Then make your API calls in the same way as with HttpClient:

```php
$this->oopsClient->request(
    'GET',
    'https://pokeapi.co/api/v2/pokemon/ditto'
);
```

That's it! If the API returns a status code greater than or equal to 400, it will be automatically recorded in your "oops" table.

## Manual error logging

Oops Bundle also gives you direct access to some methods used to interact with the oops table.

This allows you to choose which specific data to record or to manage specific error cases.

Start by injecting OopsService into your class:

```php
use VTGianni\OopsBundle\Service\OopsService;

class MyService
{
    private $oopsService;

    public function __construct(OopsService $oopsService)
    {
        $this->oopsService = $oopsService;
    }
}
```

## Report an incident

To report an incident, please use the reportError method of OopsBundle:

```php
$this->oopsService->reportError(
    $url, // required string
    $statusCode, // required int
    $message, // optional string
    $headers, // optional array
    $bodyContent, // optional array
    $responseContent // optional array
);
```

## Filter errors

To filter errors, please use the filterErrors method of OopsBundle:

```php
$this->oopsService->filterErrors(
    $errorCode, // optional int
    $desc, // optional bool, default true
    $limit // optional int, default 10
);
```

## Count errors

To count errors, please use the countErrors method of OopsBundle:

```php
$this->oopsService->countErrors(
    $nbDays, // optional int, default 7
    $errorCode // opitonal int
);
```
