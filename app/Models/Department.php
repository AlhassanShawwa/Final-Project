<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }


    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
