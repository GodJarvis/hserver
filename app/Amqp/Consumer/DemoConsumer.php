<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Utils\Logger\Log;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(exchange: 'hyperf', routingKey: 'hyperf', queue: 'hyperf', name: "DemoConsumer", nums: 1)]
class DemoConsumer extends ConsumerMessage
{
    public function consumeMessage($data, AMQPMessage $message): Result
    {
        var_dump($data);
        Log::get()->info('收到rabbitmq数据：', ['data' => $data]);
        return Result::ACK;
    }
}
