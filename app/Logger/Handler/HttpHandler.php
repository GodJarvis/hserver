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
use Monolog\Logger;
use Monolog\Utils;

class HttpHandler extends RotatingFileHandler
{
    public function __construct(string $filename, int $maxFiles = 0, $level = Logger::DEBUG, bool $bubble = true, ?int $filePermission = null, bool $useLocking = false)
    {
        parent::__construct($filename, $maxFiles, $level, $bubble, $filePermission, $useLocking);

        if (!ApplicationContext::hasContainer()) {
            return;
        }
        $container = ApplicationContext::getContainer();
        if (!$container->has(RequestInterface::class)) {
            return;
        }
        $request = $container->get(RequestInterface::class);
        /** @var Dispatched $dispatched */
        $dispatched = $request->getAttribute(Dispatched::class);
        if (!$dispatched->handler->callback instanceof Closure) {
            [$controller, $action] = $this->prepareHandler($dispatched->handler->callback);
            $controller = $this->getControllerPath($controller);
            // 构建日志文件路径
            $filename = BASE_PATH . '/runtime/logs/http' . '/' . '{date}' . '/' . $controller . '/' . $action . '.log';
            $this->filename = Utils::canonicalizePath($filename);
            $this->setFilenameFormat($this->filenameFormat, $this->dateFormat);
        }
    }

    protected function getTimedFilename(): string
    {
        if (str_contains($this->filename, '{date}')) {
            return str_replace('{date}', date($this->dateFormat), $this->filename);
        }

        $fileInfo = pathinfo($this->filename);
        $timedFilename = str_replace(
            ['{filename}', '{date}'],
            [$fileInfo['filename'], date($this->dateFormat)],
            $fileInfo['dirname'] . '/' . $this->filenameFormat
        );

        if (isset($fileInfo['extension'])) {
            $timedFilename .= '.' . $fileInfo['extension'];
        }

        return $timedFilename;
    }

    protected function getGlobPattern(): string
    {
        if (str_contains($this->filename, '{date}')) {
            return str_replace('{date}', '[0-9][0-9][0-9][0-9]*', $this->filename);
        }

        $fileInfo = pathinfo($this->filename);
        $glob = str_replace(
            ['{filename}', '{date}'],
            [$fileInfo['filename'], '[0-9][0-9][0-9][0-9]*'],
            $fileInfo['dirname'] . '/' . $this->filenameFormat
        );
        if (isset($fileInfo['extension'])) {
            $glob .= '.' . $fileInfo['extension'];
        }

        return $glob;
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