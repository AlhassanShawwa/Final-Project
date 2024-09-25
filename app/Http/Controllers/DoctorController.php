<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $Doctors;
    public function __construct(DoctorRepositoryInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Doctors->index($request);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Doctors->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        return $this->Doctors->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Doctors->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDoctorRequest $request, string $id)
    {
        return $this->Doctors->update($request, $id);
    }

    /**
     * Get Status.
     */
    public function getStatus($id)
    {
        return $this->Doctors->getStatus($id);
    }
    /**
     * Update Status.
     */
    public function updateStatus(Request $request, $id)
    {
        return $this->Doctors->updateStatus($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Doctors->destroy($id);
    }
}
