<?php

declare (strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/20
 * Time: 15:54
 */

namespace App\Model\MongoDB;

class AccessLog extends Model
{
    public string $collection = 'access_log';

    public function getCollection(): string
    {
        return $this->collection . '_' . date('Y-m', time());
    }
}