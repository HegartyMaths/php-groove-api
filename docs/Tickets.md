# Tickets

## Create a ticket

```php
$client->tickets()->create('Ticket body', 'customer@email.com', 'agent@email.com');
```

## List tickets

```php
$client->tickets()->list();
```

## Find a ticket

```php
$client->tickets()->find('ticketNumber');
```

## Find a ticket's state

```php
$client->tickets()->ticketState('ticketNumber');
```

## Find a ticket's assignee

```php
$client->tickets()->ticketAssignee('ticketNumber');
```

## Ticket count

```php
$client->tickets()->count();
```

## Update a ticket's priority

```php
$client->tickets()->updatePriority('ticketNumber', 'urgent');
```

## Update a ticket's group

```php
$client->tickets()->updateGroup('ticketNumber', 'groupID');
```
