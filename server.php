<?php


require_once __DIR__ . '/vendor/autoload.php';

use Ratchet\Kernel;

// Create a Websocket server
$ws_worker = new Kernel('websocket://0.0.0.0:8080');

$ws_worker->onConnect = Closure::fromCallable([Kernel::class, 'onConnect']);
$ws_worker->onMessage = Closure::fromCallable([Kernel::class, 'onMessage']);
$ws_worker->onClose = Closure::fromCallable([Kernel::class, 'onClose']);
$ws_worker->onError = Closure::fromCallable([Kernel::class, 'onError']);

// Run worker
Kernel::runAll();