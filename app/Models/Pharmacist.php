<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacist extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
