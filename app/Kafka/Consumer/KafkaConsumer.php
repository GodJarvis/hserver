<?php

declare(strict_types=1);

namespace App\Kafka\Consumer;

use App\Logger\Log;
use Hyperf\Kafka\AbstractConsumer;
use Hyperf\Kafka\Annotation\Consumer;
use longlang\phpkafka\Consumer\ConsumeMessage;

#[Consumer(topic: 'test_project_demo', groupId: 'test_project_demo', autoCommit: true, nums: 1)]
class KafkaConsumer extends AbstractConsumer
{
    public function consume(ConsumeMessage $message)
    {
        echo $message->getTopic() . ':' . $message->getKey() . ':' . $message->getValue() . PHP_EOL;
        Log::get()->info('获取到的kafka消息：', ['message' => $message->getValue()]);
        sleep(1);
    }
}
