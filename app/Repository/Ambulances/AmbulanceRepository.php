<?php

namespace App\Repository\Ambulances;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index($request)
    {
        $ambulances = Ambulance::all();
        if ($request->ajax()) {
            return datatables()->of($ambulances)
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('ambulances.edit', $row->id) . '" data-id="' . $row->id . '"
                    type="button" id="edit">
                        <i class="la la-edit"></i>
                    </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('ambulances.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                 <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('admin.ambulances.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.admin.ambulance.index');
    }
    public function store($request)
    {
        Ambulance::create([
            'car_number' => $request->car_number,
            'car_model' => $request->car_model,
            'car_year_made' => $request->car_year_made,
        ]);
        return response()->json(['message' => 'Service created successfully']);
    }
    public function show($id) {}
    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return response()->json([
            'id' => $ambulance->id,
            'car_number' => $ambulance->car_number,
            'car_model' => $ambulance->car_model,
            'car_year_made' => $ambulance->car_year_made
        ]);
    }
    public function update($request, $id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $ambulance->update([
            'car_number' => $request->car_number,
            'car_model' => $request->car_model,
            'car_year_made' => $request->car_year_made
        ]);
        return response()->json(['message' => 'Service updated successfully']);
    }
    public function destroy($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $ambulance->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
