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

namespace App\Controller;

use App\Constants\ErrorCode;
use App\Constants\LogGroup;
use App\Logger\Context\LogGroupContext;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    protected LoggerInterface $logger;

    public function __construct()
    {
        LogGroupContext::set(LogGroup::HTTP);
    }

    public function jsonReturn($data = [], int $code = ErrorCode::STATUS_OK, string $message = '', $extra = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->response->json([
            'status_code' => $code,
            'msg' => $message ?: ErrorCode::getMessage($code),
            'data' => $data,
            'extra' => $extra,
        ]);
    }

    public function paginationReturn($data = [], int $total = 0, int $page = 1, int $pageSize = 20, int $code = ErrorCode::STATUS_OK, string $message = '', $extra = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->response->json([
            'status_code' => $code,
            'msg' => $message ?: ErrorCode::getMessage($code),
            'data' => [
                'data' => $data,
                'page_info' => [
                    'page' => $page,
                    'page_size' => $pageSize,
                    'total' => $total,
                ]
            ],
            'extra' => $extra,
        ]);
    }
}
