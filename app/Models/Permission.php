<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * 指定模型对应数据表
     *
     * @var string
     */
    protected $table = 'permission';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * 指定模型可以批量赋值的字段
     *
     * @var array
     */
    protected $fillable = [];
}
