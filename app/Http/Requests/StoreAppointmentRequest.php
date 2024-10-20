<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Appointment;

class StoreAppointmentRequest extends FormRequest
{
    // Determine if the user is authorized to make this request
    public function authorize()
    {
        return true; // Change this based on your authorization logic
    }

    // Validation rules for the request
    public function rules()
    {
        $doctorId = $this->doctor_id;
        $patientId =  auth()->id();

        return [
            'doctor_id' =>  'required|exists:doctors,id',
            'service_type' => 'required|in:single,group',
            'service_id' =>  'required',
            'date' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) use ($doctorId, $patientId) {
                    $doctorAppointmentsCount = Appointment::where('doctor_id', $doctorId)
                        ->whereDate('date', $value)
                        ->count();
                    $pendingAppointments = Appointment::where('doctor_id', $doctorId)
                        ->where('patient_id', $patientId)
                        ->where('status', '!=', 'completed') // تأكد من أن الحالة ليست مكتملة
                        ->count();

                    if ($doctorAppointmentsCount >= 30) {
                        $fail('لقد تجاوز هذا الطبيب الحد الأقصى لعدد الحالات اليومية.');
                    }

                    if ($pendingAppointments > 0) {
                        $fail('لا يمكن إنشاء موعد جديد مع هذا الطبيب بينما لديك موعد غير مكتمل.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.required' => 'يرجى اختيار طبيب.',
            'service_type.required' => 'يرجى تحديد نوع الخدمة.',
            'service_id.required' => 'يرجى تحديد الخدمة.',
            'date.required' => 'يرجى إدخال تاريخ الموعد.',
            'date.after' => 'يجب أن يكون تاريخ الموعد في المستقبل.',
        ];
    }
}
