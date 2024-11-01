<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'treatment_medicine')
            ->withPivot('dosage', 'frequency', 'description')
            ->withTimestamps();
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
