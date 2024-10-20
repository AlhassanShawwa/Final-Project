<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Service extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Many-to-Many relationship with groups
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_service')
            ->withPivot('quantity')
            ->withTimestamps();;
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
