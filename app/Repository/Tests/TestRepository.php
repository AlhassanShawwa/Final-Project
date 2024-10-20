<?php

namespace App\Repository\Tests;

use App\Interfaces\Tests\TestRepositoryInterface;
use App\Models\Test;

class TestRepository implements TestRepositoryInterface
{
    public function index($request)
    {
        $Tests = Test::all();
        if ($request->ajax()) {
            return datatables()->of($Tests)
                ->editColumn('name', function ($row) {
                    return $row->trans_name;
                })
                ->editColumn('description', function ($row) {
                    return $row->trans_description;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return '
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-url="' . route('tests.edit', $row->id) . '" data-id="' . $row->id . '"
                    type="button" id="edit">
                        <i class="la la-edit"></i>
                    </a>
                        <span class="dropdown">
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="' . route('tests.show', $row->id) . '"><i class="la la-eye"></i> Generate Report</a>
                                 <a class="dropdown-item" id="trash" href="javascript:;" data-url="' . route('tests.destroy', $row->id) . '"><i class="la la-trash"></i>Delete Record</a>
                            </div>
                        </span>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.admin.test.index');
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
        Test::create([
            'code' => $request->code,
            'name' => $name,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Test created successfully']);
    }
    public function edit($id)
    {
        $test = Test::findOrFail($id);
        return response()->json([
            'id' => $test->id,
            'nameAr' => $test->nameAr,
            'nameEn' => $test->nameEn,
            'code' => $test->code,
            'descriptionAr' => $test->descriptionAr,
            'descriptionEn' => $test->descriptionEn,
        ]);
    }
    public function update($request, $id)
    {
        $Test = Test::findOrFail($id);
        $name = json_encode([
            'en' => $request->nameEn,
            'ar' => $request->nameAr,
        ], JSON_UNESCAPED_UNICODE);
        $description = json_encode([
            'en' => $request->descriptionEn,
            'ar' => $request->descriptionAr,
        ], JSON_UNESCAPED_UNICODE);
        $Test->update([
            'code' => $request->code,
            'name' => $name,
            'description' => $description,
        ]);
        return response()->json(['message' => 'Test updated successfully']);
    }
    public function destroy($id)
    {
        $Test = Test::findOrFail($id);
        $Test->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
