<?php

declare(strict_types=1);

namespace Ratchet\Controllers;

use Workerman\Connection\TcpConnection;

class ChatController
{
    /**
     * @var array
     */
    private static array $rooms;

    /**
     * @param TcpConnection $user
     * @param array $data
     */
    public static function registerUserToRoom(TcpConnection $user, array $data): void
    {
        self::$rooms[$data['room_id']][$data['user_id']] = $user;
    }

    /**
     * @param TcpConnection $user
     * @param array $data
     * @return void
     */
    public static function sendMessage(TcpConnection $user, array $data): void
    {
        foreach (self::$rooms[$data['room_id']] as $key => $client) {
            if($key !== $data['user_id']) {
                $client->send(json_encode([
                    'message' => $data['message'],
                    'username' => $data['username'],
                    'room_id' => $data['room_id'],
                ]));
            }
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function checkExistConnection(array $data): bool
    {
        return isset(self::$rooms[$data['room_id']][$data['user_id']]);
    }
}