PHP Groove API client
=====================

[![Build Status](https://img.shields.io/travis/HegartyMaths/php-groove-api.svg?branch=master&style=flat-square)](https://travis-ci.org/HegartyMaths/groove-api) 

A simple wrapper for the Groove API in PHP.

* [Groove](https://www.groovehq.com)
* [Groove API](https://www.groovehq.com/docs)
* [HegartyMaths](https://hegartymaths.com)

## Requirements

 - PHP >= 7.0.0

## Installation

Install via [Composer](http://getcomposer.org).

```bash
$ composer require hegartymaths/groove-api
```

## Basic usage

Visit the API Settings page (/groove_client/settings/api) via your company subdomain to find your private token.

```php
use Groove\Client;

$client = new Client('private-token');

$tickets = $client->tickets()->list();
```

## Docs
 - [Agents](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Agents.md)
 - [Attachments](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Attachments.md)
 - [Customers](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Customers.md)
 - [Folders](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Folders.md)
 - [Groups](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Groups.md)
 - [Mailboxes](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Mailboxes.md)
 - [Messages](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Messages.md)
 - [Tickets](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Tickets.md)
 - [Webhooks](https://github.com/HegartyMaths/php-groove-api/blob/master/docs/Webhooks.md)
 