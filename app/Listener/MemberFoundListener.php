<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/15
 * Time: 13:57
 */

namespace App\Listener;

use App\Event\MemberFoundEvent;
use App\Logger\Log;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MemberFoundListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            MemberFoundEvent::class,
        ];
    }

    /**
     * @param MemberFoundEvent $event
     */
    public function process(object $event): void
    {
        Log::get()->info('find member: ', ['member_info' => $event->member]);
    }
}