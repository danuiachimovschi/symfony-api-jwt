<?php

namespace Ratchet\Core\Interfaces;

use Workerman\Connection\TcpConnection;

interface KernelInterface
{
    public static function onConnect(TcpConnection $connection);
    public static function onMessage(TcpConnection $connection, string $data);
    public static function onClose(TcpConnection $connection);
    public static function onError(TcpConnection $connection, $code, $msg);
}