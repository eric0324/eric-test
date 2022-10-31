<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class QueueService {

    public function publishDone($job)
    {
        $connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.login'),
            config('rabbitmq.password')
        );

        $channel = $connection->channel();

        $channel->queue_declare(
            'notification.done',
            false,
            true,
            false,
            false);

        $data = [
            'identifier' => $job->identifier,
            "deliverAt"  => $job->deliverAt
        ];

        $msg = new AMQPMessage(json_encode($data));
        $channel->basic_publish($msg, '', 'notification.done');
    }
}
