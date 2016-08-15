<?php

namespace Core\Models;

class UserConfig extends Model
{
    protected $table = 'user_config';

    protected $fillable = [
        'id',
        'user_id',
        'key',
        'content',
    ];

}