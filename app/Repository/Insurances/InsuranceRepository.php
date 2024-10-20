<?php

namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\Insurance;


class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function index($request)
    {
        $insurances = Insurance::all();
        if ($request->ajax()) {
            return datatables()->of($insurances)
                ->editColumn('name', function ($row) {
                    return $row->trans_name;
                })
                ->editColumn('description', function ($row) {
                    return Str::words($row->trans_description, 5, '...');
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('insurances.edit', $row->id) . '" data-id="' . $row->id . '"
                    type="button" id="edit">
                        <i class="la la-edit"></i>
                    </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('insurances.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                <a class="dropdown-item" id="updatestatus" data-toggle="modal" data-target="#kt_modal_1" href="javascript:;" data-id=" ' . $row->id . ' "><i class="la la-refresh"></i> Update Status</a>
                                <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('insurances.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.admin.insurance.index');
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

        Insurance::create([
            'name' => $name,
            'code' => $request->code,
            'discount_percentage' => $request->discount_percentage,
            'rate' => $request->rate,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Insurance created successfully']);
    }
    public  function edit($id)
    {
        $insurances = Insurance::findOrFail($id);
        return response()->json([
            'id' => $insurances->id,
            'nameAr' => $insurances->name_ar,
            'nameEn' => $insurances->name_en,
            'code' => $insurances->code,
            'discount_percentage' => $insurances->discount_percentage,
            'rate' => $insurances->rate,
            'descriptionAr' => $insurances->description_ar,
            'descriptionEn' => $insurances->description_en,
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


        $insurance = Insurance::findOrFail($id);
        $insurance->update([
            'name' => $name,
            'code' => $request->code,
            'discount_percentage' => $request->discount_percentage,
            'rate' => $request->rate,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Insurance updated successfully']);
    }
    public function getStatus($id)
    {
        $insurance = Insurance::findOrFail($id);
        return response()->json(['status' => $insurance->status]);
    }
    public function updateStatus($request, $id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->status = $request->input('status');
        $insurance->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
