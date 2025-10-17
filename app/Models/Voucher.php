<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'discount', 'start_date', 'end_date'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
