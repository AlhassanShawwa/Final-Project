<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];
    public function medicine()
    {
        return $this->belongsToMany(Medicine::class, 'pharmacy_inventory');
    }
    public function pharmacists()
    {
        return $this->hasMany(Pharmacist::class);
    }
}
