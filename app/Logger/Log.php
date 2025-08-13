<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/8
 * Time: 16:19
 */

namespace App\Logger;

use Hyperf\Context\ApplicationContext;
use Hyperf\Logger\LoggerFactory;

class Log
{
    public static function get(string $group = 'http'): \Psr\Log\LoggerInterface
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($group, $group);
    }
}
