<?php

namespace Core\Models;

class UserMessage extends Model
{
    protected $table = 'UserMessage';

    protected $fillable = [
        'id',
        'user_id',
        'content',
        'type',
        'status',
        'created_at',
        'expires_at',
    ];

}