<?php

namespace Core\Models;

class SystemConfig extends Model
{
    protected $table = 'system_config';

    protected $fillable = [
        'id',
        'key',
        'content',
    ];
    
}