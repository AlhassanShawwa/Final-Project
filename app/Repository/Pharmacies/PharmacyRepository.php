<?php

namespace App\Repository\Pharmacies;

use App\Interfaces\Pharmacies\PharmacyRepositoryInterface;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Hash;

class PharmacyRepository implements PharmacyRepositoryInterface
{
    public function index($request)
    {
        $pharmacises = Pharmacy::all();
        if ($request->ajax()) {
            return datatables()->of($pharmacises)
                ->addColumn('name', function ($pharmacy) {
                    return $pharmacy->trans_name;
                })
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('pharmacies.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('pharmacies.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                 <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('pharmacies.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.admin.pharmacy.index');
    }
    public function create()
    {
        return view('dashboard.admin.pharmacy.create');
    }
    public function store($request)
    {
        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);
        $password = rand();
        Pharmacy::create([
            'name' => $name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'password' => Hash::make($password),
            'type' => $request->type,
        ]);
        return redirect()->route('pharmacies.index');
    }
    public function edit($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        if (request()->ajax()) {
            if ($pharmacy) {
                return response()->json([
                    'data' => [
                        'namear' => $pharmacy->name_ar,
                        'nameen' => $pharmacy->name_en,
                        'email' => $pharmacy->email,
                        'phone' => $pharmacy->phone,
                        'location' => $pharmacy->location,
                        'type' => $pharmacy->type,
                    ]
                ]);
            }
        };
        return view('dashboard.admin.pharmacy.edit', compact('pharmacy'));
    }
    public function show($id) {}
    public function update($request, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $name = json_encode([
            'en' => $request->nameen,
            'ar' => $request->namear,
        ], JSON_UNESCAPED_UNICODE);
        $pharmacy->update([
            'name' => $name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'type' => $request->type,
        ]);
        return redirect()->route('pharmacies.index');
    }
    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
