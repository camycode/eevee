<?php

namespace Core\Logs;

use Core\Models\Model;
use Illuminate\Support\Facades\DB;

class EmailLog extends Model
{
    protected $table = 'email_log';

    protected $fillable = [
        'email',
        'content',
        'status_code',
        'status_message',
        'ip',
        'send_begin_at',
        'send_end_at',
    ];

    public $timestamps = false;

}