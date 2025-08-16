<?php

declare(strict_types=1);

namespace App\Middleware\JsonRpc;

use App\Constants\LogGroup;
use App\Utils\Logger\Context\LogGroupContext;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LogContextMiddleware implements MiddlewareInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        LogGroupContext::set(LogGroup::JSON_RPC);
        return $handler->handle($request);
    }
}
