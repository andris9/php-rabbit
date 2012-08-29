# PHP_Rabbit

This is an extremely simple AMQP client for RabbitMQ. Currently it can only publish data to the server.

## Requirements

  * **PHP 5.3+**

## Installation

    git clone git://github.com/andris9/php-rabbit.git
    cd php-rabbit
    git submodule init

## Usage

Include the module

```php
<?php
include_once "/path/to/php-rabbit/rabbit.php";
```

Configure server info

```php
<?php
Rabbit\config($host, $port=5672, $user, $pass, $vhost="/");
```

Publish something to server

```php
<?php
Rabbit\publish($key, $data[, $contentType="text/plain"[, $exchange="amq.default"]]);
```

Example:

```php
<?php
include_once "/path/to/php-rabbit/rabbit.php";
Rabbit\config("rabbit1", null, "guest", "guest");
Rabbit\publish("news", "No news :S");
```