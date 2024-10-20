<?php

namespace App\Repository\Patients;

use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{
    public function index($request)
    {
        $patients = Patient::all();
        if ($request->ajax()) {
            return datatables()->of($patients)
                ->addColumn('name', function ($patient) {
                    $imagePath = $patient->image
                        ? asset('uploads/patients/' . $patient->image)
                        : asset('uploads/patients/' . $patient->gender . '.jpg');
                    return '
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <img src="' . $imagePath . '" class="m-img-rounded kt-marginless" alt="photo">
                        </div>
                        <div class="kt-user-card-v2__details">
                            <span class="kt-user-card-v2__name">' . $patient->trans_full_name . '</span>
                         </div>
                    </div>';
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('patients.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('patients.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                 <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('patients.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.admin.patient.index');
    }
    public function create()
    {
        return view('dashboard.admin.patient.create');
    }
    public function store($request)
    {
        $firstname = json_encode([
            'en' => $request->firstnameen,
            'ar' => $request->firstnamear,
        ], JSON_UNESCAPED_UNICODE);
        $lastname = json_encode([
            'en' => $request->lastnameen,
            'ar' => $request->lastnamear,
        ], JSON_UNESCAPED_UNICODE);
        $address = json_encode([
            'en' => $request->addressen,
            'ar' => $request->addressar,
        ], JSON_UNESCAPED_UNICODE);
        $img_name = null;
        if ($request->hasFile('image')) {
            $img_name = rand() . rand() . rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/patients/'), $img_name);
        }
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $password = rand();
        Patient::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'image' => $img_name,
            'email' => $request->email,
            'address' => $address,
            'password' => Hash::make($password),
            'date_of_birth' => $dateOfBirth,
            'gender' => $request->gender,
        ]);
        return redirect()->route('patients.index');
    }
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        if (request()->ajax()) {
            if ($patient) {
                return response()->json([
                    'data' => [
                        'image' => $patient->image,
                        'firstnamear' => $patient->first_name_ar,
                        'lastnamear' => $patient->last_name_ar,
                        'firstnameen' => $patient->first_name_en,
                        'lastnameen' => $patient->last_name_en,
                        'email' => $patient->email,
                        'phone' => $patient->phone,
                        'addressar' => $patient->address_ar,
                        'addressen' => $patient->address_en,
                        'date_of_birth' => $patient->date_of_birth,
                        'gender' => $patient->gender,
                    ]
                ]);
            }
        };
        return view('dashboard.admin.patient.edit', compact('patient'));
    }
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return view('dashboard.patient.show');
    }
    public function update($request, $id)
    {
        $patient = Patient::findOrFail($id);
        $firstname = json_encode([
            'en' => $request->firstnameen,
            'ar' => $request->firstnamear,
        ], JSON_UNESCAPED_UNICODE);

        $lastname = json_encode([
            'en' => $request->lastnameen,
            'ar' => $request->lastnamear,
        ], JSON_UNESCAPED_UNICODE);
        $address = json_encode([
            'en' => $request->addressen,
            'ar' => $request->addressar,
        ], JSON_UNESCAPED_UNICODE);
        $img_name = $patient->image;
        if ($request->hasFile('image')) {
            $img_name = rand() . rand() . rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/doctors'), $img_name);
        }
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $patient->update([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'image' => $img_name,
            'email' => $request->email,
            'address' => $address,
            'date_of_birth' => $dateOfBirth,
            'gender' => $request->gender,
        ]);
        return redirect()->route('patients.index');
    }
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        if ($patient->image) {
            File::delete(public_path('uploads/patients/' . $patient->image));
        };
        $patient->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
