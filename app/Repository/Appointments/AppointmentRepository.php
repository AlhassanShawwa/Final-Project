<?php

namespace App\Repository\Appointments;

use App\Models\Doctor;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Appointments\AppointmentRepositoryInterface;
use App\Models\Group;
use App\Models\Patient;
use App\Models\Service;
use Carbon\Carbon;
use Psy\Readline\Hoa\Console;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function index($request)
    {
        if (Auth::guard('admin')->check()) {
            $departments = Department::all();
            $appointments = Appointment::with(['patient', 'doctor'])->get();
            if ($request->ajax()) {
                return datatables()->of($appointments)
                    ->addColumn('patient_name', function ($row) {
                        return $row->patient->trans_full_name;
                    })
                    ->addColumn('doctor_name', function ($row) {
                        return $row->doctor->trans_full_name;
                    })
                    ->addColumn('actions', function ($row) {
                        return '
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('appointments.edit', $row->id) . '" data-id="' . $row->id . '" type="button" id="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('appointments.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('appointments.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }
            return view('dashboard.admin.appointment.index', compact('appointments', 'departments'));
        } elseif (Auth::guard('doctor')->check()) {
            $doctorId = Auth::guard('doctor')->id();
            $appointments = Appointment::where('doctor_id', $doctorId)->with('patient')->get();
            if ($request->ajax()) {
                return datatables()->of($appointments)
                    ->addColumn('patient_name', function ($row) {
                        return $row->patient->trans_full_name;
                    })->make(true);
            }
            return view('dashboard.doctor.appointment.index', compact('appointments'));
        } elseif (Auth::guard('web')->check()) {
            $patientId = Auth::guard('web')->id();
            $appointments = Appointment::where('patient_id', $patientId)->with('doctor')->get();
            if ($request->ajax()) {
                return datatables()->of($appointments)
                    ->addColumn('doctor_name', function ($row) {
                        return $row->doctor->trans_full_name;
                    })
                    ->addColumn('actions', function ($row) {
                        return '
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View" data-url="' . route('patient.appointments.show', $row->id) . '" data-id="' . $row->id . '" type="button" id="view">
                        <i class="la la-eye"></i>
                    </a>
                ';
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }
            return view('dashboard.patient.appointment.index');
        }
    }
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.patient.appointment.create', compact('departments'));
    }

    public function store($request)
    {
        $patient_id = auth()->id();

        try {
            if ($request->service_type === 'single') {
                Appointment::create([
                    'patient_id' => $patient_id,
                    'doctor_id' => $request->doctor_id,
                    'service_type' => 'single',
                    'service_id' => $request->service_id,
                    'date' => $request->date,
                ]);

                return response()->json(['message' => 'Appointment created successfully!'], 200);
            } elseif ($request->service_type === 'group') {
                Appointment::create([
                    'patient_id' => $patient_id,
                    'doctor_id' => $request->doctor_id,
                    'service_type' => 'group',
                    'group_id' => $request->service_id,
                    'date' => $request->date,
                ]);

                return response()->json(['message' => 'Appointment created successfully!'], 200);
            } else {
                return response()->json(['error' => 'Service ID or Group ID is required based on service type.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create appointment: ' . $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json([
            'patient' => $appointment->patient,
            'doctor_id' => $appointment->doctor_id,
            'department_id' => $appointment->doctor->department_id,
            'appointment_date' => $appointment->appointment_date,
        ]);
    }
    public function show($id) {}
    public function update($request, $id) {}
    public function dailyAppointments($request)
    {
        $doctorId = Auth::guard('doctor')->id();
        $today = now()->toDateString();
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->where('date', $today)
            ->where('status', '!=', 'completed')
            ->with('patient')
            ->get();
        if ($request->ajax()) {
            return datatables()->of($appointments)
                ->addColumn('patient_name', function ($row) {
                    return $row->patient->trans_full_name;
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('doctor.appointments.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="diagnosis" data-toggle="modal" data-target="#kt_modal_4_2" href="javascript:;" data-id=" ' . $row->id . ' "data-patient-id="' . $row->patient->id . '"    ><i class="la la-clipboard"></i> Patient Diagnosis</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('doctor.appointments.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
         return view('dashboard.doctor.appointment.daily');
    }
    public function getDoctors($id)
    {
        $doctors = Doctor::where('department_id', $id)->get()->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->trans_full_name,
            ];
        });
        return response()->json(['doctors' => $doctors]);
    }
    public function getServices($request, $id)
    {
        $serviceType = $request->query('service_type');
        if ($serviceType === 'single') {
            $services = Service::where('department_id', $id)
                ->where('status', 'active')
                ->get()
                ->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'name' => $service->trans_name,
                    ];
                });
        } elseif ($serviceType === 'group') {
            $services = Group::where('department_id', $id)
                ->where('status', 'active')
                ->get()
                ->map(function ($group) {
                    return [
                        'id' => $group->id,
                        'name' => $group->trans_name,
                    ];
                });
        }
        return response()->json($services);
    }
    public function getServiceDetails($request, $id)
    {
        $serviceType = $request->query('service_type');
        $service = '';
        if ($serviceType === 'single') {
            $service = Service::findOrFail($id);
            return response()->json([
                'id' => $service->id,
                'name' => $service->trans_name,
                'price' => $service->price,
            ]);
        } elseif ($serviceType === 'group') {
            $service = Group::with('services')->findOrFail($id);
            return response()->json([
                'id' => $service->id,
                'name' => $service->trans_name,
                'total_with_tax' => $service->total_with_tax,
                'services' => $service->services->map(function ($subService) {
                    return [
                        'id' => $subService->id,
                        'name' => $subService->trans_name,
                        'price' => $subService->price,
                    ];
                }),



            ]);
        }
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        return response()->json($service);
    }
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
