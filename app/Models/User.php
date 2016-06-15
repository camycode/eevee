<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 指定模型对应数据表
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * 指定模型可以批量赋值的字段
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'email', 'password', 'avatar', 'status', 'source', 'created_at', 'updated_at'];

    /**
     * 指定读取数据表时隐藏字段
     *
     * @var array
     */
    protected $hidden = ['password'];
}
