<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'full_name',
        'email',
        'phone_number',
        'address',
        'gender',
        'dob',
        'loyalty_points',
        'status',
        'note',
    ];
}
