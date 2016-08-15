<?php

namespace Core\Models;

class UserToken extends Model
{
    protected $table = 'user_token';

    protected $fillable = [
        'app_id',
        'app_version',
        'user_id',
        'user_token',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}