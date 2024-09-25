<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{

    private $Ambulances;
    public function __construct(AmbulanceRepositoryInterface $Ambulances)
    {
        $this->Ambulances = $Ambulances;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Ambulances->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbulanceRequest $request)
    {
        return $this->Ambulances->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Ambulances->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Ambulances->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAmbulanceRequest $request, string $id)
    {
        return $this->Ambulances->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Ambulances->destroy($id);
    }
}
