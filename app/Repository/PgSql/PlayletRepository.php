<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/15
 * Time: 14:45
 */

namespace App\Repository\PgSql;

use App\Model\PgSql\Playlet;
use Hyperf\Di\Annotation\Inject;

class PlayletRepository
{
    #[Inject]
    public Playlet $playlet;

    public function getPlaylet(): Playlet
    {
        return $this->playlet->newQuery()->first();
    }
}