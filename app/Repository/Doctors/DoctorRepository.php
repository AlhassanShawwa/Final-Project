<?php

namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function index($request)
    {
        $doctors = Doctor::all();
        if ($request->ajax()) {
            return datatables()->of($doctors)
                ->addColumn('name', function ($doctor) {
                    $imagePath = $doctor->image
                        ? asset('uploads/doctors/' . $doctor->image)
                        : asset('uploads/doctors/' . $doctor->gender . '.jpg');
                    return '
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <img src="' . $imagePath . '" class="m-img-rounded kt-marginless" alt="photo">
                        </div>
                        <div class="kt-user-card-v2__details">
                            <span class="kt-user-card-v2__name">' . $doctor->trans_full_name . '</span>
                            <a href="' . route('admin.departments.show', $doctor->department->id) . '" class="kt-user-card-v2__email kt-link">' . $doctor->department->trans_name . '</a>
                        </div>
                    </div>';
                })

                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('admin.doctors.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('admin.doctors.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('admin.doctors.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.admin.doctor.index');
    }
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.admin.doctor.create', compact('departments'));
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
        $img_name = null;
        if ($request->hasFile('image')) {
            $img_name = rand() . rand() . rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/doctors/'), $img_name);
        }
        $password = rand();
        Doctor::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'image' => $img_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'date_of_birth' => $request->date,
            'gender' => $request->gender,
            'department_id' => $request->department,
            'status' => 'active',
        ]);
        return redirect()->route('doctors.index');
    }
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        if (request()->ajax()) {
            if ($doctor) {
                return response()->json([
                    'data' => [
                        'image' => $doctor->image,
                        'firstnamear' => $doctor->first_name_ar,
                        'lastnamear' => $doctor->last_name_ar,
                        'firstnameen' => $doctor->first_name_en,
                        'lastnameen' => $doctor->last_name_en,
                        'email' => $doctor->email,
                        'phone' => $doctor->phone,
                        'department' => $doctor->department_id,
                        'date_of_birth' => $doctor->date_of_birth,
                        'gender' => $doctor->gender,
                    ]
                ]);
            }
        };
        $departments = Department::all();
        return view('dashboard.admin.doctor.edit', compact('doctor', 'departments'));
    }
    public function update($request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $firstname = json_encode([
            'en' => $request->firstnameen,
            'ar' => $request->firstnamear,
        ], JSON_UNESCAPED_UNICODE);

        $lastname = json_encode([
            'en' => $request->lastnameen,
            'ar' => $request->lastnamear,
        ], JSON_UNESCAPED_UNICODE);

        $img_name = $doctor->image;
        if ($request->hasFile('image')) {
            $img_name = rand() . rand() . rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/doctors'), $img_name);
        }
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $doctor->update([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'image' => $img_name,
            'email' => $request->email,
            'date_of_birth' => $dateOfBirth,
            'gender' => $request->gender,
            'department_id' => $request->department,
            'status' => 'active',
        ]);
        return redirect()->route('doctors.index');
    }
    public function getStatus($id)
    {
        $doctor = Doctor::findOrFail($id);
        return response()->json(['status' => $doctor->status]);
    }
    public function updateStatus($request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->status = $request->input('status');
        $doctor->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor->image) {
            File::delete(public_path('uploads/doctors/' . $doctor->image));
        };
        $doctor->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
