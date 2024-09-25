<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsuranceRequest;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    private $Insurances;
    public function __construct(InsuranceRepositoryInterface $Insurances)
    {
        $this->Insurances = $Insurances;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Insurances->index($request);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return $this->Insurances->create();
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuranceRequest $request)
    {
        return $this->Insurances->store($request);
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
        return $this->Insurances->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInsuranceRequest $request, string $id)
    {
        return $this->Insurances->update($request, $id);
    }
    /**
     * Get Status.
     */
    public function getStatus($id)
    {
        return $this->Insurances->getStatus($id);
    }
    /**
     * Update Status.
     */
    public function updateStatus(Request $request, $id)
    {
        return $this->Insurances->updateStatus($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Insurances->destroy($id);
    }
}
