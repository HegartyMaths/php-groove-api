PHP Groove API client
=====================

A simple wrapper for the Groove API in PHP.

* [Groove](https://www.groovehq.com)
* [Groove API](https://www.groovehq.com/docs)
* [HegartyMaths](https://hegartymaths.com)

## Installation

Install via [Composer](http://getcomposer.org).

```bash
$ composer require hegartymaths/groove-api
```

## Basic usage

```php
use Groove\Client;

$client = new Client('access-token');

$tickets = $client->tickets()->list();
```
