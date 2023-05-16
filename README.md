<p align="center">
  <img src="asset/logo.png" width="300" title="Logo" alt="Logo">
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
