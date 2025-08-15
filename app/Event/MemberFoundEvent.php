<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 20:35
 */

namespace App\Event;

use App\Model\MySQL\Member;

class MemberFoundEvent
{
    public Member $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }
}