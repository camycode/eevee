<?php

namespace Core\Logs;

use Core\Models\Model;
use Illuminate\Support\Facades\DB;

class LoginLog extends Model
{
    protected $table = 'login_log';

    protected $fillable = [
        'account',
        'mode',
        'status_code',
        'status_message',
        'ip',
        'user_agent',
        'login_at',
    ];

    public $timestamps = false;

}