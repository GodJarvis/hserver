<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/16
 * Time: 13:40
 */

namespace App\Utils;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Kafka\Producer;

class KafkaClient
{
    #[Inject]
    public Producer $producer;

    public function publish(string $topic, ?string $value, ?string $key = null, array $headers = [], ?int $partitionIndex = null)
    {
        $this->producer->send($topic, $value, $key, $headers, $partitionIndex);
    }
}