<?php

namespace App\Repository\Drivers;

use App\Interfaces\Drivers\DriverRepositoryInterface;
use App\Models\Ambulance;
use App\Models\Driver;
use Carbon\Carbon;

class DriverRepository implements DriverRepositoryInterface
{
    public function index($request)
    {
        $drivers = Driver::all();
        if ($request->ajax()) {
            return datatables()->of($drivers)
                ->editColumn('name', function ($row) {
                    return $row->trans_full_name;
                })
                ->editColumn('car_number', function ($row) {
                    return $row->ambulance->car_number;
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('drivers.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('drivers.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('drivers.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name', 'car_number'])
                ->make(true);
        }
        return view('dashboard.driver.index');
    }
    public function create()
    {
        $ambulances = Ambulance::all();
        return view('dashboard.admin.driver.create', compact('ambulances'));
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

        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        Driver::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'license_number' => $request->license_number,
            'date_of_birth' => $dateOfBirth,
            'ambulance_id' => $request->ambulance,
            'status' => 'active',
        ]);
        return redirect()->route('drivers.index');
    }
    public function show($id) {}
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        if (request()->ajax()) {
            if ($driver) {
                return response()->json([
                    'data' => [
                        'firstnamear' => $driver->first_name_ar,
                        'lastnamear' => $driver->last_name_ar,
                        'firstnameen' => $driver->first_name_en,
                        'lastnameen' => $driver->last_name_en,
                        'license_number' => $driver->license_number,
                        'phone' => $driver->phone,
                        'ambulance' => $driver->ambulance_id,
                        'date_of_birth' => $driver->date_of_birth,
                    ]
                ]);
            }
        };
        $ambulances = Ambulance::all();
        return view('dashboard.admin.driver.edit', compact('driver', 'ambulances'));
    }
    public function update($request, $id)
    {
        $driver = Driver::findOrFail($id);

        $firstname = json_encode([
            'en' => $request->firstnameen,
            'ar' => $request->firstnamear,
        ], JSON_UNESCAPED_UNICODE);
        $lastname = json_encode([
            'en' => $request->lastnameen,
            'ar' => $request->lastnamear,
        ], JSON_UNESCAPED_UNICODE);
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $driver->update([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone' => $request->phone,
            'license_number' => $request->license_number,
            'date_of_birth' => $dateOfBirth,
            'ambulance_id' => $request->ambulance,
        ]);
        return redirect()->route('drivers.index');
    }
    public function getStatus($id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json(['status' => $driver->status]);
    }
    public function updateStatus($request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->status = $request->input('status');
        $driver->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
