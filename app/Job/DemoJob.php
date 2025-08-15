<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 20:36
 */

namespace App\Job;

use App\Logger\Log;
use Hyperf\AsyncQueue\Job;

class DemoJob extends Job
{
    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle()
    {
        Log::get()->info('从redis异步队列中获取到的消息体：', ['payload' => $this->payload]);
    }
}