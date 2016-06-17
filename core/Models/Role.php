<?php

namespace Core\Models;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'id',
        'name',
        'description',
        'parent',
        'status',
        'source',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}