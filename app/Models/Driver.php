<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;


class Driver extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}
