<?php

namespace App\Repository\Pharmacists;

use App\Interfaces\Pharmacists\PharmacistRepositoryInterface;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\Pharmacy;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PharmacistRepository implements PharmacistRepositoryInterface
{
    public function index($request)
    {
        $pharmacists = Pharmacist::all();
        if ($request->ajax()) {
            return datatables()->of($pharmacists)
                ->addColumn('name', function ($pharmacist) {
                    $imagePath = $pharmacist->image
                        ? asset('uploads/pharmacist/' . $pharmacist->image)
                        : asset('uploads/pharmacist/' . $pharmacist->gender . '.jpg');
                    return '
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <img src="' . $imagePath . '" class="m-img-rounded kt-marginless" alt="photo">
                        </div>
                        <div class="kt-user-card-v2__details">
                            <span class="kt-user-card-v2__name">' . $pharmacist->trans_full_name . '</span>
                            <a href="' . route('pharmacies.show', $pharmacist->pharmacy->id) . '" class="kt-user-card-v2__email kt-link">' . $pharmacist->pharmacy->trans_name . '</a>
                        </div>
                    </div>';
                })

                ->addColumn('actions', function ($row) {
                    return '
                        <a href="' . route('pharmacists.edit', $row->id) . '" class="btn btn-sm btn-clean  btn-icon btn-icon-md" title="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('pharmacists.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-print"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('pharmacists.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions', 'name'])
                ->make(true);
        }
        return view('dashboard.pharmacist.index');
    }
    public function create()
    {
        $pharmacies = Pharmacy::all();
        return view('dashboard.admin.pharmacist.create', compact('pharmacies'));
    }
    public function store($request)
    {
        // $firstname = json_encode([
        //     'en' => $request->firstnameen,
        //     'ar' => $request->firstnamear,
        // ], JSON_UNESCAPED_UNICODE);
        // $lastname = json_encode([
        //     'en' => $request->lastnameen,
        //     'ar' => $request->lastnamear,
        // ], JSON_UNESCAPED_UNICODE);
        // $img_name = null;
        // if ($request->hasFile('image')) {
        //     $img_name = rand() . rand() . rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
        //     $request->file('image')->move(public_path('uploads/pharmacists/'), $img_name);
        // }
        // $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        // Pharmacy::create([
        //     'first_name' => $firstname,
        //     'last_name' => $lastname,
        //     'phone' => $request->phone,
        //     'image' => $img_name,
        //     'date_of_birth' => $dateOfBirth,
        //     'gender' => $request->gender,
        //     'pharmacy_id' => $request->pharmacy,
        //     'status' => 'active',
        // ]);
        // return redirect()->route('pharmacists.index');
    }
    public function edit($id) {}
    public function show($id) {}
    public function update($request, $id) {}
    public function destroy($id) {}
}
