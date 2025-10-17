<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['treatment_id', 'session_date', 'notes'];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
