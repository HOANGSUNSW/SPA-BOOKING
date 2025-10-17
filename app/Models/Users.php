<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'gender', 'dob', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'dob' => 'date',
        'password' => 'hashed',
    ];

    // JWT methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Đặt lại password field cho Laravel
    public function getAuthPassword()
    {
        return $this->password;
    }

public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function schedules()
    {
        return $this->hasMany(StaffSchedule::class, 'staff_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function loyaltyPoints()
    {
        return $this->hasOne(LoyaltyPoint::class);
    }
}
