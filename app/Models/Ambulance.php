<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Ambulance extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}
