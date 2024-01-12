<?php

declare(strict_types=1);

namespace Ratchet\Core;

use Ratchet\Core\Interfaces\UserConnectionInterface;
use Workerman\Connection\TcpConnection;

final class UserConnection implements UserConnectionInterface
{
    public function __construct(
        public TcpConnection $connection
    )
    {
    }

    /**
     * Get ID Of Connection
     * @return string
     */
    public function getConnectionId(): string
    {
        return spl_object_hash($this);
    }
}