<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'service_id', 'name', 'description', 'status', 'expiry_date'];

    public function user() { return $this->belongsTo(User::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function histories() { return $this->hasMany(TreatmentHistory::class); }
}
