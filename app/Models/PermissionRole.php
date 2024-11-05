<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    public $table = "permission_role"; //when we have already migrated and want to inegrate with model

    protected $fillable = [
        'permission_id',
        'role_id',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function roles()
    {
        return $this->belongsTo(Permission::class);
    }
}
