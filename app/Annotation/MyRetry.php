<?php

declare(strict_types=1);

namespace App\Annotation;

use Attribute;
use Hyperf\Retry\Annotation\AbstractRetry;
use Hyperf\Retry\BackoffStrategy;
use Hyperf\Retry\Policy\ClassifierRetryPolicy;
use Hyperf\Retry\Policy\MaxAttemptsRetryPolicy;
use Hyperf\Retry\Policy\SleepRetryPolicy;

#[Attribute(Attribute::TARGET_METHOD)]
class MyRetry extends AbstractRetry
{
    public array $policies = [
        MaxAttemptsRetryPolicy::class,
        ClassifierRetryPolicy::class,
        SleepRetryPolicy::class
    ];

    public int $maxAttempts = 3;

    public int $base = 2000;

    public string $sleepStrategyClass = BackoffStrategy::class;
}