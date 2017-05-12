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

### Tickets

#### Create a ticket

```php
$client->tickets()->create('Ticket body', 'customer@email.com', 'agent@email.com');
```

#### List tickets

```php
$client->tickets()->list();
```

#### Find a ticket

```php
$client->tickets()->find('ticketNumber');
```

#### Find a ticket's state

```php
$client->tickets()->ticketState('ticketNumber');
```

#### Find a ticket's assignee

```php
$client->tickets()->ticketAssignee('ticketNumber');
```

#### Ticket count

```php
$client->tickets()->count();
```

#### Update a ticket's priority

```php
$client->tickets()->updatePriority('ticketNumber', 'urgent');
```

#### Update a ticket's group

```php
$client->tickets()->updateGroup('ticketNumber', 'groupID');
```
