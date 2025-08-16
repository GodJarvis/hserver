<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/13
 * Time: 14:18
 */

namespace App\Controller\Admin;

use App\Utils\Logger\Log;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
class TestLogController extends BaseController
{
    public function testHttpGroup()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        Log::get()->info('默认目录和文件名日志写入：', ['user' => $user, 'method' => $method]);
        Log::get('default')->info('使用default组写入日志：', ['user' => $user, 'method' => $method]);
        return $this->jsonReturn([
            'method' => $method,
            'message' => "Hello {$user}.",
        ]);
    }
}