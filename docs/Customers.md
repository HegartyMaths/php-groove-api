# Customers

## List customers

```php
$client->customers()->list();
```

## Find a customer

```php
$client->customers()->find('customer@email.com');
```

## Update a customer

```php
$client->customers()->update('existing@email.com', 'new@email.com', ['name' => 'Customer']);
```
