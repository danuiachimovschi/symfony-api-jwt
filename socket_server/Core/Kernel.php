<?php

namespace Ratchet\Core;

use Ratchet\Controllers\ChatController;
use Ratchet\Core\Interfaces\KernelInterface;
use Workerman\Connection\TcpConnection;

class Kernel extends \Workerman\Worker implements KernelInterface
{
    protected static $clients;

    public function __construct($socket_name, $context_option = [])
    {
        self::$clients = new \SplObjectStorage();
        parent::__construct($socket_name, $context_option);
    }

    public static function onConnect(TcpConnection $connection)
    {
        self::$clients->attach($connection);
    }

    /**
     * @param TcpConnection $connection
     * @param string $data
     * @return void
     */
    public static function onMessage(TcpConnection $connection,string $data)
    {
        $data = json_decode($data, true);


        if (isset($data->token)) $connection->close();

        if($data['subscribe'] === "chat") {

            if(!ChatController::checkExistConnection($data)) {
                ChatController::registerUserToRoom($connection, $data);
            }

            if($data['action'] === 'sendMessage') {
                ChatController::sendMessage($connection, $data);
            }
        }
    }

    public static function onClose(TcpConnection $connection)
    {
        self::$clients->detach($connection);
    }

    public static function onError(TcpConnection $connection, $code, $msg)
    {
        self::$clients->detach($connection);
    }
}