<?php

namespace Core\Models;

class RolePermission extends Model
{
    protected $table = 'role_permission';

    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    
}