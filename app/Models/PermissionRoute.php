<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoute extends Model
{
    use HasFactory;
    public $table = "permission_router"; //when we have already migrated and want to inegrate with model

    protected $fillable = [
        'permission_id',
        'router'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
