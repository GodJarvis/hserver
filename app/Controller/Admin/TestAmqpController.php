<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 20:11
 */

namespace App\Controller\Admin;

use App\Amqp\Producer\DemoProducer;
use Hyperf\Amqp\Producer;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
class TestAmqpController extends BaseController
{
    #[Inject]
    public Producer $producer;

    public function publish()
    {
        $message = new DemoProducer(['datetime' => date('Y-m-d H:i:s')]);
        $result = $this->producer->produce($message, true);
        return $this->jsonReturn($result);
    }
}