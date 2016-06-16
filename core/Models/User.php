<?php

namespace Core\Models;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'id',
        'role',
        'username',
        'email',
        'password',
        'name',
        'avatar',
        'source',
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}