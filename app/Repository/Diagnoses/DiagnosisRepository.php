<?php

namespace App\Repository\Diagnoses;

use App\Interfaces\Diagnoses\DiagnosisRepositoryInterface;
use App\Models\Appointment;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Auth;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function store($request)
    {
        $doctorId = Auth::guard('doctor')->id();
        $date = now()->toDateString();
        $diagnosis = json_encode([
            'en' => $request->diagnosis_en,
            'ar' => $request->diagnosis_ar,
        ], JSON_UNESCAPED_UNICODE);

        Diagnosis::create([
            'patient_id' => $request->patient_id,
            'diagnosis' => $diagnosis,
            'doctor_id' => $doctorId,
            'date' => $date,
        ]);
        
        $appointmentId = $request->appointment_id;
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'completed';
        $appointment->save();
    }
}
