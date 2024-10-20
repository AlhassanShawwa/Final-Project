<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Interfaces\Departments\DepartmentRepositoryInterface;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\Service;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{


    private $Departments;
    public function __construct(DepartmentRepositoryInterface $Departments)
    {
        $this->Departments = $Departments;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Departments->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        return $this->Departments->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        return $this->Departments->show($request, $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Departments->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartmentRequest $request, string $id)
    {
        return $this->Departments->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Departments->destroy($id);
    }
}
