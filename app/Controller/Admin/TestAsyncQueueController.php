<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 20:11
 */

namespace App\Controller\Admin;

use App\Job\DemoJob;
use App\Utils\Logger\Log;
use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
class TestAsyncQueueController extends BaseController
{
    #[Inject]
    public DriverFactory $driverFactory;

    public function push()
    {
        $payload = ['name' => 'godjarvis'];
        $delay = 0;
        $this->driverFactory->get('default')->push(new DemoJob($payload), $delay);
        Log::get()->info('push message success:', ['message' => $payload]);
        return $this->jsonReturn();
    }
}