<?php

namespace Rabbit;

include_once(__DIR__ . '/php-amqplib/amqp.inc');
include_once(__DIR__ . '/config.php');

use \Rabbit\AMQP as AMQP;

class local{
    public static $connection;
    public static $channel;
}

local::$connection = new AMQP\AMQPConnection(HOST, PORT, USER, PASS, VHOST);
local::$channel = local::$connection->channel();

function publish($topic, $data, $contentType = 'text/plain', $exchange = 'amq.topic'){
    if(!$contentType){
        $contentType = 'text/plain';
    }
    
    if(!$exchange){
        $exchange = 'amq.topic';
    }

    $msg = new AMQP\AMQPMessage($data, array('content_type' => $contentType));
    local::$channel->basic_publish($msg, $exchange, $topic);
}

function disconnect(){
    local::$channel->close();
    local::$connection->close();
}

register_shutdown_function('\\Rabbit\\disconnect');