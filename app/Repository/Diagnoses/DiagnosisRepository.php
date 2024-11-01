<?php

namespace App\Repository\Diagnoses;

use App\Interfaces\Diagnoses\DiagnosisRepositoryInterface;
use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function store($request)
    {
        $doctorId = Auth::guard('doctor')->id();
        $appointment_id = $request->appointment_id;

        DB::beginTransaction();

        try {
            $Diagnosis = json_encoDe([
                'en' => $request->diagnosis_ar,
                'ar' => $request->diagnosis_en,
            ], JSON_UNESCAPED_UNICODE);

            $diagnosis = Diagnosis::create([
                'diagnosis' => $Diagnosis,
                'patient_id' => $request->patient_id,
                'doctor_id' => $doctorId,
                'appointment_id' => $appointment_id,
                'date' => now(),
            ]);

            $treatment = Treatment::create([
                'patient_id' => $request->patient_id,
                'doctor_id' => $doctorId,
                'appointment_id' => $appointment_id,
            ]);
            $medicines = $request->medicines;
            $treatment->medicines()->attach(
                collect($medicines)->map(function ($medicine) {
                    return [
                        'medicine_id' => $medicine['medicine'],
                        'dosage' => $medicine['dosage'],
                        'frequency' => $medicine['frequency'],
                        'description' => $medicine['description'],
                    ];
                })->toArray()
            );
            $appointment = Appointment::findOrFail($appointment_id);
            $appointment->status =  'completed';
            $appointment->save();
            DB::commit();
            return response()->json(['success' => 'Diagnosis and medicines saved successfully.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Something went wrong, please try again.'], 500);
        }
    }
}
