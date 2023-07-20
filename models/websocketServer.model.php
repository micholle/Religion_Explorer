<?php

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use React\EventLoop\Factory;
use React\Socket\Server;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/../vendor/autoload.php';

class ForumWebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (!$data || !isset($data['type'])) {
            return;
        }

        // Handle the received message and broadcast to all connected clients
        switch ($data['type']) {
            case 'discussion':
                $this->broadcast($msg);
                break;
            case 'topics':
                $this->broadcast($msg);
                break;
            default:
                break;
        }
    }

    protected function broadcast($msg)
    {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
// websocket-server.php
$loop = Factory::create();

// Replace 8080 with the desired port number for your WebSocket server
$socket = new Server('0.0.0.0:8080', $loop);
$server = new IoServer(
    new HttpServer(
        new WsServer(
            new ForumWebSocketServer()
        )
    ),
    $socket,
    $loop
);

echo "WebSocket server is running on port 8080...\n";
$server->run();
