<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/8
 * Time: 16:42
 */

namespace App\Logger\Handler;

use Closure;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Stringable\Str;
use Monolog\Handler\RotatingFileHandler;
use Monolog\LogRecord;

class HttpHandler extends RotatingFileHandler
{
    private function getHttpLogPath(): string
    {
        if (!ApplicationContext::hasContainer()) {
            return '';
        }
        $container = ApplicationContext::getContainer();
        if (!$container->has(RequestInterface::class)) {
            return '';
        }
        $request = $container->get(RequestInterface::class);
        /** @var Dispatched $dispatched */
        $dispatched = $request->getAttribute(Dispatched::class);
        if ($dispatched && !$dispatched->handler->callback instanceof Closure) {
            [$controller, $action] = $this->prepareHandler($dispatched->handler->callback);
            $controller = $this->getControllerPath($controller);
            return BASE_PATH . '/runtime/logs/http/' . $controller . '/' . $action . '.log';
        }
        return '';
    }

    protected function write(LogRecord $record): void
    {
        $targetPath = $this->getHttpLogPath();
        if ($targetPath && $this->url !== $targetPath) {
            $this->url = $targetPath;
            $this->close();
        }

        parent::write($record);
    }

    private function prepareHandler($handler): array
    {
        if (is_string($handler)) {
            if (str_contains($handler, '@')) {
                return explode('@', $handler);
            }
            return explode('::', $handler);
        }
        if (is_array($handler) && isset($handler[0], $handler[1])) {
            return $handler;
        }
        throw new \RuntimeException('Handler not exist.');
    }

    private function getControllerPath(string $className): string
    {
        $handledNamespace = Str::replaceFirst('Controller', '', Str::after($className, '\\Controller\\'));
        $handledNamespace = str_replace('\\', '/', $handledNamespace);
        $prefix = Str::snake($handledNamespace);
        return str_replace('/_', '/', $prefix);
    }
}