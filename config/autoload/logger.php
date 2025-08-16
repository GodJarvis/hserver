<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

return [
    App\Constants\LogGroup::DEFAULT => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/hyperf.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
    App\Constants\LogGroup::HTTP => [
        'handler' => [
            'class' => \App\Utils\Logger\Handler\HttpHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/http/http.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
    App\Constants\LogGroup::JSON_RPC => [
        'handler' => [
            'class' => \App\Utils\Logger\Handler\JsonRpcHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/json-rpc/service.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
    App\Constants\LogGroup::AMQP => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/amqp/amqp.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
    App\Constants\LogGroup::COMMAND => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/command/command.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
    App\Constants\LogGroup::KAFKA => [
        'handler' => [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/kafka/kafka.log',
                'level' => Monolog\Level::Debug,
            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => null,
            ],
        ],
        'processors' => [
            [
                'class' => \App\Utils\Logger\Processor\AppendRequestIdProcessor::class,
            ],
        ],
    ],
];
