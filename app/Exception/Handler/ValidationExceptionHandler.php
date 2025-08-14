<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 11:20
 */

namespace App\Exception\Handler;

use App\Constants\ErrorCode;
use App\Trait\HttpServerResponseFormatTrait;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\Annotation\ExceptionHandler as RegisterHandler;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

#[RegisterHandler(server: 'http')]
class ValidationExceptionHandler extends ExceptionHandler
{
    use HttpServerResponseFormatTrait;

    public function __construct(protected StdoutLoggerInterface $logger)
    {
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        $this->stopPropagation();
        /** @var ValidationException $throwable */
        return $this->jsonReturn($throwable->errors(), ErrorCode::VALIDATION_FAILED);
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}