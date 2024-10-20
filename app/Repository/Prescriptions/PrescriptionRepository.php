<?php

namespace App\Repository\Prescriptions;

use App\Interfaces\Prescriptions\PrescriptionRepositoryInterface;
use App\Models\Prescription;

class PrescriptionRepository implements PrescriptionRepositoryInterface
{
    public function index($request)
    {
        $prescriptions = Prescription::all();
        if ($request->ajax()) {
            return datatables()->of($prescriptions)
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
                        </span>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.doctor.prescription.index');
    }
    public function create() {}
    public function store($request) {}
    public function edit($id) {}
    public function show($id) {}
    public function update($request, $id) {}
    public function destroy($id) {}
}
