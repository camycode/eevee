<?php

namespace Core\Models;

class Resource extends Model
{
    protected $table = 'resource';

    protected $fillable = [
        'id',
        'name',
        'description',
        'source',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}