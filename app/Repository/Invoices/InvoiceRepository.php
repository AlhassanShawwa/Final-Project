<?php

namespace App\Repository\Invoices;

use Log;
use App\Models\Doctor;
use App\Models\Patient;
use App\Interfaces\Invoices\InvoiceRepositoryInterface;
use App\Models\Appointment;
use App\Models\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index($request)
    {
        $invoices = Invoice::all();

        if ($request->ajax()) {
            return datatables()->of($invoices)
                ->editColumn('patient_name', function ($row) {
                    'return $row->patient->trans_full_name';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.admin.invoice.index');
    }
    public function create()
    {
        $patients = Patient::all();
        return view('dashboard.admin.invoice.create', compact('patients'));
    }
    public function store($request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $amount = 0;
        if ($appointment->service_type == 'single') {
            $amount = $appointment->service->price;
        } elseif ($appointment->service_type == 'group') {
            $amount = $appointment->group->total_with_tax;
        }
        $isSaved =  Invoice::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'total_price' => $amount,
        ]);


        if ($isSaved) {
            $appointment->status =  'scheduled';
            $appointment->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['message' => 'Invoice created successfully.'], 201);
    }
    public function getPatientData($id)
    {
        $patient = Patient::findOrFail($id);
        $appointment = $patient->appointments()->where('status', 'hanging')->first();

        if ($appointment) {
            $doctor = $appointment->doctor;
            $department = $doctor->department;
            if ($appointment->service_type === 'single') {
                $service = $appointment->service;
                $servicePrice = $service->price;
                return response()->json([
                    'doctor' => $doctor->trans_full_name,
                    'department' => $department->trans_name,
                    'appointment_date' => $appointment->date,
                    'appointment_id' => $appointment->id,
                    'service_type' => $appointment->service_type,
                    'service_name' => $service->trans_name,
                    'service_price' => $servicePrice,
                ]);
            } elseif ($appointment->service_type === 'group') {
                $group = $appointment->group;
                $groupServices = $group->services;
                $servicesData = $groupServices->map(function ($service) {
                    return [
                        'service_name' => $service->trans_name,
                        'service_price' => $service->price,
                        'quantity' => $service->pivot->quantity,
                    ];
                });
                $totalPrice = $group->total_with_tax;
                return response()->json([
                    'doctor' => $doctor->trans_full_name,
                    'department' => $department->trans_name,
                    'appointment_date' => $appointment->date,
                    'appointment_id' => $appointment->id,
                    'group_name' => $group->trans_name,
                    'sub_services' => $servicesData,
                    'total_price' => $totalPrice,
                ]);
            }
        } else {
            return response()->json(['error' => 'No hanging appointments found for this patient'], 404);
        }

        return response()->json(['error' => 'An error occurred. Check the logs for details.'], 500);
    }
}
