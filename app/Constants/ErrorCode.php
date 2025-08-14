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

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\Annotation\Message;

#[Constants]
class ErrorCode extends AbstractConstants
{
    #[Message("Success.")]
    public const int STATUS_OK = 1;

    #[Message("Failed.")]
    public const int STATUS_FAILURE = -1;

    #[Message("Authentication Failed.")]
    public const int AUTHENTICATION_FAILED = -100;

    #[Message("Validation Failed.")]
    public const int VALIDATION_FAILED = -102;
}
