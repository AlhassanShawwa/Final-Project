<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
