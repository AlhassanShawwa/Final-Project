<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pharmacy()
    {
        return $this->belongsToMany(Pharmacy::class, 'pharmacy_inventory');
    }
    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'treatment_medicine')
            ->withPivot('dosage', 'frequency', 'description')
            ->withTimestamps();
    }
}
