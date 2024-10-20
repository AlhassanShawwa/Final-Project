<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Trans;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Trans;
    protected $guarded = [];

    // Many-to-Many relationship with services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'group_service')
            ->withPivot('quantity')
            ->withTimestamps();;
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
