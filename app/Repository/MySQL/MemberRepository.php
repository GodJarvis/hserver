<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 19:23
 */

namespace App\Repository\MySQL;

use App\Model\MySQL\Member;
use Hyperf\Di\Annotation\Inject;

class MemberRepository
{
    #[Inject]
    public Member $member;

    public function getMemberById(int $id): Member
    {
        return $this->member->newQuery()->where('id', '=', $id)->first();
    }
}