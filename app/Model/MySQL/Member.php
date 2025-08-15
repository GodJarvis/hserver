<?php

declare(strict_types=1);

namespace App\Model\MySQL;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $app_type
 * @property int $mini_app_id
 * @property string $open_id
 * @property string $union_id
 * @property string $channel_key
 * @property int $channel_type
 * @property int $pay_display
 * @property int $distributor_id
 * @property string $seq_time
 * @property string $reg_time
 * @property string $last_login_time
 * @property int $weixin_blongs_id
 * @property int $status
 * @property int $system_type
 * @property string $create_time
 * @property string $update_time
 */
class Member extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'zshu_member';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'app_type' => 'integer', 'mini_app_id' => 'integer', 'channel_type' => 'integer', 'pay_display' => 'integer', 'distributor_id' => 'integer', 'weixin_blongs_id' => 'integer', 'status' => 'integer', 'system_type' => 'integer'];
}
