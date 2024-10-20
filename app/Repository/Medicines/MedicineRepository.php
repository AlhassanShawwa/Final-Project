<?php

namespace App\Repository\Medicines;

use App\Imports\MedicinesImport;
use App\Interfaces\Medicines\MedicineRepositoryInterface;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MedicineRepository implements MedicineRepositoryInterface
{
    public function index($request)
    {
        $medicines = Medicine::all();

        if ($request->ajax()) {
            return datatables()->of($medicines)
                ->addColumn('actions', function ($row) {
                    return '
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('medicines.edit', $row->id) . '" data-id="' . $row->id . '"
                        type="button" id="edit">
                            <i class="la la-edit"></i>
                        </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('medicines.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('medicines.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.admin.medicine.index');
    }

    public function store($request)
    {
        Medicine::create([
            'name' => $request->name,
            'code' => $request->code,
            'manufacturer' => $request->manufacturer,
        ]);
        return response()->json(['message' => 'Medicine created successfully']);
    }
    public function show($id) {}
    public function import($request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

        $addedCount = 0; // Counter for added medicines

        try {
            Excel::import(new MedicinesImport(function ($imported) use (&$addedCount) {
                if ($imported) {
                    $addedCount++;
                }
            }), $request->file('file'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Check if any medicines were added
        if ($addedCount > 0) {
            return response()->json(['message' => "$addedCount medicines added successfully."]);
        } else {
            return response()->json(['error' => 'No new medicines were added. All items already exist.'], 400);
        }
    }

    public function getMedicines()
    {
        $medicines = Medicine::all();
        return response()->json($medicines);
    }


    public function edit($id)
    {
        $Medicine = Medicine::findOrFail($id);
        return response()->json([
            'id' => $Medicine->id,
            'name' => $Medicine->name,
            'code' => $Medicine->code,
            'manufacturer' => $Medicine->manufacturer
        ]);
    }
    public function update($request, $id)
    {
        $Medicine = Medicine::findOrFail($id);
        $Medicine->update([
            'name' => $request->name,
            'code' => $request->code,
            'manufacturer' => $request->manufacturer
        ]);
        return response()->json(['message' => 'Medicine updated successfully']);
    }
    public function destroy($id)
    {
        $Medicine = Medicine::findOrFail($id);
        $Medicine->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
