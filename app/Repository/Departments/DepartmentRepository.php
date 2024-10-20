<?php

namespace App\Repository\Departments;

use App\Interfaces\Departments\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function index($request)
    {

        $departments = Department::all();
        if (request()->ajax()) {
            return datatables()->of($departments)
                ->editColumn('name', function ($row) {
                    return '<a class="btn" href="' . route('admin.departments.show', $row->id) . '">' . $row->trans_name . '</a>';
                })
                ->editColumn('address', function ($row) {
                    return $row->trans_address;
                })
                ->editColumn('description', function ($row) {
                    return $row->trans_description;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('admin.departments.edit', $row->id) . '" data-id="' . $row->id . '"
                    type="button" id="edit">
                        <i class="la la-edit"></i>
                    </a>
                    <span class="dropdown">
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                          <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="' . route('admin.departments.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                        <a class="dropdown-item" href="javascript:;"><i class="la la-print"></i> Update Status</a>
                        <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('admin.departments.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                        </div>
                    </span>';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.admin.department.index');
    }
    public function store($request)
    {
        $name = json_encode([
            'en' => $request->nameEn,
            'ar' => $request->nameAr,
        ], JSON_UNESCAPED_UNICODE);
        $address = json_encode([
            'en' => $request->addressEn,
            'ar' => $request->addressAr,
        ], JSON_UNESCAPED_UNICODE);
        $description = json_encode([
            'en' => $request->descriptionEn,
            'ar' => $request->descriptionAr,
        ], JSON_UNESCAPED_UNICODE);

        Department::create([
            'name' => $name,
            'address' => $address,
            'description' => $description,
        ]);
        return response()->json(['message' => 'sssssss']);
    }
    public function show($request, $id)
    {
        $department = Department::findOrFail($id);
        $doctors = $department->doctors;
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
        return view('dashboard.admin.department.show-doctors', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return response()->json([
            'id' => $department->id,
            'nameAr' => $department->name_ar,
            'nameEn' => $department->name_en,
            'addressAr' => $department->address_ar,
            'addressEn' => $department->address_en,
            'descriptionAr' => $department->description_ar,
            'descriptionEn' => $department->description_en
        ]);
    }
    public function update($request, $id)
    {
        $name = json_encode([
            'en' => $request->nameEn,
            'ar' => $request->nameAr,
        ], JSON_UNESCAPED_UNICODE);
        $address = json_encode([
            'en' => $request->addressEn,
            'ar' => $request->addressAr,
        ], JSON_UNESCAPED_UNICODE);
        $description = json_encode([
            'en' => $request->descriptionEn,
            'ar' => $request->descriptionAr,
        ], JSON_UNESCAPED_UNICODE);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $name,
            'address' => $address,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Department updated successfully']);
    }
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
