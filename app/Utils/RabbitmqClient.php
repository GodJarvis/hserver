<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/16
 * Time: 13:49
 */

namespace App\Utils;

use Hyperf\Amqp\Message\ProducerMessageInterface;
use Hyperf\Amqp\Producer;
use Hyperf\Di\Annotation\Inject;

class RabbitmqClient
{
    #[Inject]
    public Producer $producer;

    public function publish(ProducerMessageInterface $producerMessage, bool $confirm = false, int $timeout = 5): bool
    {
        return $this->producer->produce($producerMessage, $confirm, $timeout);
    }
}