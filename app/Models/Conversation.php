<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)
            ->latest();
    }
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id')
            ->withDefault();
    }


  

    public function otherParticipant($currentUser)
    {
        if ($currentUser instanceof Doctor) {
            return $this->patient; // عرض المريض في حالة كان المستخدم الحالي طبيبًا
        }

        if ($currentUser instanceof Patient) {
            return $this->doctor; // عرض الطبيب في حالة كان المستخدم الحالي مريضًا
        }

        return null;
    }
}
