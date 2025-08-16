<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/16
 * Time: 13:35
 */

namespace App\Utils;

use Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\AsyncQueue\JobInterface;
use Hyperf\Di\Annotation\Inject;

class AsyncQueueClient
{
    #[Inject]
    public DriverFactory $driverFactory;

    public function push(JobInterface $job, int $delay = 0): bool
    {
        return $this->driverFactory->get('default')->push($job, $delay);
    }
}