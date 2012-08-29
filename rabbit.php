<?php

namespace Rabbit;

include_once(__DIR__ . '/php-amqplib/amqp.inc');

use \Rabbit\AMQP as AMQP;

class local{
    public static $connection;
    public static $channel;

    private static $host;
    private static $port;
    private static $user;
    private static $pass;
    private static $vhost;

    public static function ensureConnection(){
        if(!local::$connection){
            self::$connection = new AMQP\AMQPConnection(self::$host, self::$port, self::$user, self::$pass, self::$vhost);
            self::$channel = self::$connection->channel();
        }
    }

    public static function config($host, $port, $user, $pass, $vhost = "/"){
        self::$host = $host;
        self::$port = $port?$port:5672;
        self::$user = $user;
        self::$pass = $pass;
        self::$vhost = $vhost?$vhost:"/";
    }
}

function config($host, $port, $user, $pass, $vhost = "/"){
    local::config($host, $port, $user, $pass, $vhost);
}

function publish($topic, $data, $contentType = 'text/plain', $exchange = 'amq.default'){
    
    local::ensureConnection();

    if(!$contentType){
        $contentType = 'text/plain';
    }
    
    if(!$exchange){
        $exchange = 'amq.default';
    }

    $msg = new AMQP\AMQPMessage($data, array('content_type' => $contentType));
    local::$channel->basic_publish($msg, $exchange, $topic);
}

function disconnect(){
    local::$channel->close();
    local::$connection->close();
}

register_shutdown_function('Rabbit\\disconnect');