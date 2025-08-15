<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/15
 * Time: 14:42
 */

namespace App\Model\PgSql;

class Playlet extends Model
{
    protected ?string $connection = 'pgsql';

    protected ?string $table = 'ods_mysql_zhangyu.playlet';
}