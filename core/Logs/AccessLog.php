<?php

namespace Core\Logs;

use Core\Models\Model;
use Illuminate\Support\Facades\DB;

class AccessLog extends Model
{
    protected $table = 'access_log';

    protected $fillable = [
        'method',
        'uri',
        'request_params',
        'request_data',
        'status_code',
        'status_message',
        'status_data',
        'ip',
        'access_begin_at',
        'access_end_at',
    ];

    public $timestamps = false;
    
}