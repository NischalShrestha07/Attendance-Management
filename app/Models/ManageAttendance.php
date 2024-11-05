<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'date', 'status', 'login_time', 'login_time', 'month',  'geolocation',];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
