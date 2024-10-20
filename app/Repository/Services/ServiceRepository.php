<?php

namespace App\Repository\Services;

use App\Models\Service;
use Illuminate\Support\Str;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Department;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function index($request)
    {
        $services = Service::all();
        $departments = Department::all();
        if ($request->ajax()) {
            return datatables()->of($services)
                ->editColumn('name', function ($row) {
                    return $row->trans_name;
                })
                ->editColumn('department', function ($row) {
                    return '<a class="btn" href="' . route('admin.departments.show', $row->department->id) . '">' . $row->department->trans_name . '</a>';
                })
                ->editColumn('description', function ($row) {
                    return Str::words($row->trans_description, 5, '...');
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('admin.services.edit', $row->id) . '" data-id="' . $row->id . '"
                        type="button" id="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('admin.services.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-refresh"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('admin.services.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'department'])
                ->make(true);
        }

        return view('dashboard.admin.service.index', compact('departments'));
    }
    public function store($request)
    {
        $name = json_encode([
            'en' => $request->nameEn,
            'ar' => $request->nameAr,
        ], JSON_UNESCAPED_UNICODE);
        $description = json_encode([
            'en' => $request->descriptionEn,
            'ar' => $request->descriptionAr,
        ], JSON_UNESCAPED_UNICODE);

        Service::create([
            'name' => $name,
            'price' => $request->price,
            'department_id' => $request->department,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Service created successfully']);
    }
    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return response()->json([
            'id' => $services->id,
            'nameAr' => $services->name_ar,
            'nameEn' => $services->name_en,
            'price' => $services->price,
            'descriptionAr' => $services->description_ar,
            'descriptionEn' => $services->description_en,
            'department' => $services->department_id
        ]);
    }
    public function update($request, $id)
    {
        $name = json_encode([
            'en' => $request->nameEn,
            'ar' => $request->nameAr,
        ], JSON_UNESCAPED_UNICODE);
        $description = json_encode([
            'en' => $request->descriptionEn,
            'ar' => $request->descriptionAr,
        ], JSON_UNESCAPED_UNICODE);
        $service = Service::findOrFail($id);
        $service->update([
            'name' => $name,
            'price' => $request->price,
            'department_id' => $request->department,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Service updated successfully']);
    }
    public function getStatus($id)
    {
        $service = Service::findOrFail($id);
        return response()->json(['status' => $service->status]);
    }
    public function updateStatus($request, $id)
    {
        $service = Service::findOrFail($id);
        $service->status = $request->input('status');
        $service->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
