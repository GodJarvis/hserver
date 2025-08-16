<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 16:41
 */

namespace App\Utils\Logger\Listener;

use App\Constants\LogGroup;
use App\Utils\Logger\Context\LogGroupContext;
use Hyperf\Command\Event\BeforeHandle;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Kafka\Event\BeforeConsume;

#[Listener]
class KafkaLogContextListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            BeforeConsume::class,
        ];
    }

    /**
     * @param BeforeHandle $event
     */
    public function process(object $event): void
    {
        LogGroupContext::set(LogGroup::KAFKA);
    }
}