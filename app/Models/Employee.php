<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'employee_code',
        'user_id',
        'full_name',
        'gender',
        'phone_number',
        'id_card',
        'address',
        'email',
        'status',
        'role',
        'note'
    ];

    // Một nhân viên có nhiều bản ghi chấm công (1-N)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

     public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
