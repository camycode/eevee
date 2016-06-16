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
    
    /**
     * 密码加密
     *
     * @param $origin
     */
    public static function encryptPassword($origin)
    {
        return sha1($origin);
    }

}