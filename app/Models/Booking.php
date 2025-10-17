<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_id', 'staff_id', 'voucher_id',
        'appointment_time', 'status', 'note'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function staff() { return $this->belongsTo(User::class, 'staff_id'); }
    public function voucher() { return $this->belongsTo(Voucher::class); }
    public function payment() { return $this->hasOne(Payment::class); }
}
