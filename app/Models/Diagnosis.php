<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];
    public function treatment()
    {
        return $this->hasOne(Treatment::class);
    }
}
