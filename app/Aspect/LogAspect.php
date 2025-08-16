<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/13
 * Time: 14:42
 */

namespace App\Aspect;

use App\Controller\Admin\TestLogController;
use App\Utils\Logger\Log;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[Aspect]
class LogAspect extends AbstractAspect
{
    // 要切入的类或 Trait，可以多个，亦可通过 :: 标识到具体的某个方法，通过 * 可以模糊匹配
    public array $classes = [
        TestLogController::class,
    ];

    // 要切入的注解，具体切入的还是使用了这些注解的类，仅可切入类注解和类方法注解
    public array $annotations = [
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        Log::get()->info('切面切入前记录日志');
        $result = $proceedingJoinPoint->process();
        Log::get()->info('切面切入前记录日志');
        return $result;
    }
}