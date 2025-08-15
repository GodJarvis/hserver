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

namespace App\Controller\Admin;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Kafka\Producer;

#[AutoController]
class TestKafkaController extends BaseController
{
    #[Inject]
    public Producer $producer;

    public function publish()
    {
        $this->producer->send('test_project_demo', 'value-' . time(), 'key' . time());
        return $this->jsonReturn();
    }
}
