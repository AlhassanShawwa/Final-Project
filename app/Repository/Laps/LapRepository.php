<?php

namespace App\Repository\Laps;

use App\Interfaces\Laps\LapRepositoryInterface;
use App\Models\Lap;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Hash;

class LapRepository implements LapRepositoryInterface
{
    public function index($request)
    {
        $laps = Lap::all();
        if ($request->ajax()) {
            return datatables()->of($laps)
                ->addColumn('name', function ($lap) {
                    return $lap->trans_name;
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('laps.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('laps.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                 <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('laps.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.admin.lap.index');
    }
    public function create()
    {
        return view('dashboard.admin.lap.create');
    }
    public function store($request)
    {
        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);
        $password = rand();
        Lap::create([
            'name' => $name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'password' => Hash::make($password),
            'type' => $request->type,
        ]);
        return redirect()->route('laps.index');
    }
    public function edit($id)
    {
        $lap = Lap::findOrFail($id);
        if (request()->ajax()) {
            if ($lap) {
                return response()->json([
                    'data' => [
                        'namear' => $lap->name_ar,
                        'nameen' => $lap->name_en,
                        'email' => $lap->email,
                        'phone' => $lap->phone,
                        'location' => $lap->location,
                        'type' => $lap->type,
                    ]
                ]);
            }
        };
        return view('dashboard.admin.lap.edit', compact('lap'));
    }
    public function show($id) {}
    public function update($request, $id)
    {
        $lap = Lap::findOrFail($id);
        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);
        $lap->update([
            'name' => $name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'type' => $request->type,
        ]);
        return redirect()->route('laps.index');
    }
    public function destroy($id)
    {
        $lap = Lap::findOrFail($id);
        $lap->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
