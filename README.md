# PHP_Rabbit

This is an extremely simple AMQP client for RabbitMQ. Currently it can only publish data to the server.

## Requirements

  * **PHP 5.3+**

## Installation

    git clone git://github.com/andris9/php-rabbit.git
    cd php-rabbit
    git submodule init

## Usage

Update php-rabbit/config.php

Include the module

    include_once "/path/to/php-rabbit/ampq.php";

Publish something to server

    \Rabbit\publish($key, $data[, $contentType="text/plain"[, $exchange="amq.topic"]]);

Example:

    include_once "/path/to/php-rabbit/ampq.php";
    \Rabbit\publish("news.world.today", "No news :S");