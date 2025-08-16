<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/8
 * Time: 16:42
 */

namespace App\Utils\Logger\Handler;

use Closure;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Router\Dispatched;
use Hyperf\Rpc\Contract\RequestInterface;
use Hyperf\Stringable\Str;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;

class JsonRpcHandler extends RotatingFileHandler
{
    public function __construct(string $filename, int $maxFiles = 0, int|string|Level $level = Level::Debug, bool $bubble = true, ?int $filePermission = null, bool $useLocking = false, string $dateFormat = self::FILE_PER_DAY, string $filenameFormat = '{filename}-{date}')
    {
        $container = ApplicationContext::getContainer();
        if ($container->has(RequestInterface::class)) {
            $request = $container->get(RequestInterface::class);
            /** @var Dispatched $dispatched */
            $dispatched = $request->getAttribute(Dispatched::class);
            if (!$dispatched->handler->callback instanceof Closure) {
                [$controller, $action] = $this->prepareHandler($dispatched->handler->callback);
                $controller = $this->getControllerPath($controller);
                // 构建日志文件路径
                $filename = BASE_PATH . '/runtime/logs/json-rpc/' . $controller . '/' . $action . '.log';
            }
        }
        parent::__construct($filename, $maxFiles, $level, $bubble, $filePermission, $useLocking, $dateFormat, $filenameFormat);
    }

    protected function prepareHandler($handler): array
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

    protected function getControllerPath(string $className): string
    {
        $handledNamespace = Str::replaceFirst('Controller', '', Str::after($className, '\\Controller\\'));
        $handledNamespace = str_replace('\\', '/', $handledNamespace);
        $prefix = Str::snake($handledNamespace);
        return str_replace('/_', '/', $prefix);
    }
}