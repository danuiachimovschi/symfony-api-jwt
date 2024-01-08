<?php

namespace Ratchet\Interfaces;

interface KernelInterface
{
    public static function onConnect($connection);
    public static function onMessage($connection, $data);
    public static function onClose($connection);
    public static function onError($connection, $code, $msg);
}