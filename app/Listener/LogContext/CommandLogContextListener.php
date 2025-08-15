<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 16:41
 */

namespace App\Listener\LogContext;

use App\Constants\LogGroup;
use App\Logger\Context\LogGroupContext;
use Hyperf\Command\Event\BeforeHandle;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class CommandLogContextListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            BeforeHandle::class,
        ];
    }

    /**
     * @param BeforeHandle $event
     */
    public function process(object $event): void
    {
        LogGroupContext::set(LogGroup::COMMAND);
    }
}