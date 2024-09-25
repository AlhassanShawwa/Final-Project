<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Trans;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];
}
