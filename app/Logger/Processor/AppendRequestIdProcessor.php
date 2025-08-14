<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/8
 * Time: 16:22
 */

namespace App\Logger\Processor;

use Hyperf\Context\ApplicationContext;
use Hyperf\Context\Context;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Snowflake\IdGeneratorInterface;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class AppendRequestIdProcessor implements ProcessorInterface
{
    public const string REQUEST_ID = 'log.request.id';

    public function __invoke(array|LogRecord $record)
    {
        $requestId = ApplicationContext::getContainer()->get(IdGeneratorInterface::class)->generate();
        $record['extra']['request_id'] = Context::getOrSet(self::REQUEST_ID, $requestId);
        $record['extra']['coroutine_id'] = Coroutine::id();
        return $record;
    }
}
