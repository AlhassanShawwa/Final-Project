<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyRequest;
use App\Interfaces\Pharmacies\PharmacyRepositoryInterface;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    private $Pharmacies;
    public function __construct(PharmacyRepositoryInterface $Pharmacies)
    {
        $this->Pharmacies = $Pharmacies;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Pharmacies->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Pharmacies->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {
        return $this->Pharmacies->store($request);
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
        return $this->Pharmacies->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePharmacyRequest $request, string $id)
    {
        return $this->Pharmacies->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Pharmacies->destroy($id);
    }
}
