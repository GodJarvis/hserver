<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/13
 * Time: 16:15
 */

namespace App\Service;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;

class BaseService
{
    #[Inject]
    protected ContainerInterface $container;
}