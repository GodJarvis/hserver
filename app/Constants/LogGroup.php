<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 10:15
 */

namespace App\Constants;

class LogGroup
{
    public const string DEFAULT = 'default';
    public const string HTTP = 'http';
    public const string JSON_RPC = 'json-rpc';
    public const string AMQP = 'amqp';
    public const string COMMAND = 'command';
    public const string KAFKA = 'kafka';
}