<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 11:10
 */

namespace App\Trait;

use App\Constants\ErrorCode;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

trait HttpServerResponseFormatTrait
{
    #[Inject]
    protected ResponseInterface $response;

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