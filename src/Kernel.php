<?php

namespace Ratchet;


class Kernel extends \Workerman\Worker
{
    protected static $clients;

    public function __construct($socket_name, $context_option = [])
    {
        self::$clients = new \SplObjectStorage();
        parent::__construct($socket_name, $context_option);
    }

    public static function onConnect($connection)
    {
        self::$clients->attach($connection);
        echo "New connection\n";
    }

    public static function onMessage($connection, $data)
    {
        
        echo "New message\n";
        foreach (self::$clients as $client) {
            if ($connection !== $client) {
                $client->send($data);
            }
        }
    }

    public static function onClose($connection)
    {
        self::$clients->detach($connection);
        echo "Connection closed\n";
    }

    public static function onError($connection, $code, $msg)
    {
        self::$clients->detach($connection);
        echo "Error $code $msg\n";
    }
}