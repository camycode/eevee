<?php

namespace Core\Models;

class AppVersion extends Model
{
    protected $table = 'app_version';

    protected $fillable = [
        'app_id',
        'version',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}