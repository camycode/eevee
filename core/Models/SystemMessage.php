<?php

namespace Core\Models;

class SystemMessage extends Model
{
    protected $table = 'system_message';

    protected $fillable = [
        'id',
        'content',
        'type',
        'status',
        'created_at',
        'expires_at',
    ];

}