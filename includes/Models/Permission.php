<?php

namespace Core\Models;

class Permission extends Model
{
    protected $table = 'permission';

    protected $fillable = [
        'id',
        'resource_id',
        'name',
        'description',
        'source',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}