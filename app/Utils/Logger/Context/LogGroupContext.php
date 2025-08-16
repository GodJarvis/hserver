<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 09:45
 */

namespace App\Utils\Logger\Context;

use App\Constants\LogGroup;
use Hyperf\Context\Context;

class LogGroupContext
{
    private const string LOG_REQUEST_GROUP = 'log.request.group';

    public static function get(?int $coroutineId = null, string $default = LogGroup::DEFAULT): string
    {
        return Context::get(self::LOG_REQUEST_GROUP, $default, $coroutineId);
    }

    public static function set(string $groupName, ?int $coroutineId = null): string
    {
        return Context::set(self::LOG_REQUEST_GROUP, $groupName, $coroutineId);
    }

    public static function has(?int $coroutineId = null): bool
    {
        return Context::has(self::LOG_REQUEST_GROUP, $coroutineId);
    }
}