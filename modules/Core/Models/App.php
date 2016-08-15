<?php

namespace Core\Models;

class App extends Model
{
    protected $table = 'app';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

}