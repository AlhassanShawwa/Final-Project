<?php

namespace App\Repository\Groups;

use App\Models\Group;
use App\Models\Service;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Interfaces\Groups\GroupRepositoryInterface;

class GroupRepository implements GroupRepositoryInterface
{
    public function index($request)
    {
        $groups = Group::all();
        if ($request->ajax()) {
            return datatables()->of($groups)
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
                        <a href="' . route('admin.group-services.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('admin.group-services.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('admin.group-services.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name', 'department'])
                ->make(true);
        }
        return view('dashboard.admin.group_services.index');
    }
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.admin.group_services.create', compact('departments'));
    }

    public function get_services($id)
    {
        $services = Service::where('department_id', $id)->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'price' => $service->price,
                'name' => $service->trans_name,
            ];
        });
        return response()->json(['services' => $services]);
    }

    public function store($request)
    {
        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);

        $description = json_encode([
            'en' => $request->descriptionen,
            'ar' => $request->descriptionar,
        ], JSON_UNESCAPED_UNICODE);

        $services = $request->input('services', []);
        $totalBeforeDiscount = array_sum(array_column($services, 'total'));
        $discount = $request->discount;
        $totalAfterDiscount = $totalBeforeDiscount - $discount;
        $taxRate = $request->tax_rate;
        $totalWithTax = $totalAfterDiscount * (1 + $taxRate / 100);

        $group = Group::create([
            'name' => $name,
            'department_id' => $request->department,
            'description' => $description,
            'total_before_discount' => $totalBeforeDiscount,
            'discount' => $discount,
            'total_after_discount' => $totalAfterDiscount,
            'tax_rate' => $taxRate,
            'total_with_tax' => $totalWithTax,
        ]);

        foreach ($request->services as $service) {
            $group->services()->attach($service['service_id'], [
                'quantity' => $service['quantity']
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تمت إضافة البيانات بنجاح!',
        ]);
    }
    public function show($id) {}
    public function edit($id)
    {
        $group = Group::with('services')->findOrFail($id);
        if (request()->ajax()) {
            if ($group) {
                return response()->json([
                    'data' => [
                        'namear' => $group->namear,
                        'nameen' => $group->nameen,
                        'descriptionar' => $group->descriptionar,
                        'descriptionen' => $group->descriptionen,
                        'department' => $group->department_id,
                        'discount' => $group->discount,
                        'tax_rate' => $group->tax_rate,
                        'services' => $group->services->map(function ($service) {
                            return [
                                'service_id' => $service->id,
                                'name' => $service->trans_name,
                                'price' => $service->price,
                                'quantity' => $service->pivot->quantity,
                            ];
                        }),
                    ]
                ]);
            }
        }

        $departments = Department::all();
        return view('dashboard.admin.group_services.edit', compact('group', 'departments'));
    }
    public function update($request, $id)
    {
        $group = Group::findOrFail($id);

        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);

        $description = json_encode([
            'en' => $request->descriptionen,
            'ar' => $request->descriptionar,
        ], JSON_UNESCAPED_UNICODE);

        $services = $request->input('services', []);
        $totalBeforeDiscount = array_sum(array_column($services, 'total'));
        $discount = $request->discount;
        $totalAfterDiscount = $totalBeforeDiscount - $discount;
        $taxRate = $request->tax_rate;
        $totalWithTax = $totalAfterDiscount * (1 + $taxRate / 100);

        $group->update([
            'name' => $name,
            'department_id' => $request->department,
            'description' => $description,
            'total_before_discount' => $totalBeforeDiscount,
            'discount' => $discount,
            'total_after_discount' => $totalAfterDiscount,
            'tax_rate' => $taxRate,
            'total_with_tax' => $totalWithTax,
        ]);

        // تحديث الخدمات أو إضافتها
        foreach ($services as $service) {
            $group->services()->syncWithoutDetaching([
                $service['service_id'] => ['quantity' => $service['quantity']]
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تمت تحديث البيانات بنجاح!',
        ]);
    }


    public function getStatus($id)
    {
        $group = Group::findOrFail($id);
        return response()->json(['status' => $group->status]);
    }
    public function updateStatus($request, $id)
    {
        $group = Group::findOrFail($id);
        $group->status = $request->input('status');
        $group->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->services()->detach();
        $group->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
