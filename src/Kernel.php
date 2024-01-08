<?php

namespace Ratchet;

use Ratchet\Interfaces\KernelInterface;

class Kernel extends \Workerman\Worker implements KernelInterface
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
    }

    public static function onMessage($connection, $data)
    {
        $data = json_decode($data, true);

        if (isset($data->toekn)) $connection->close();


        foreach (self::$clients as $client) {
            if ($connection !== $client) {
                $client->send($data);
            }
        }
    }

    public static function onClose($connection)
    {
        self::$clients->detach($connection);
    }

    public static function onError($connection, $code, $msg)
    {
        self::$clients->detach($connection);
    }
}