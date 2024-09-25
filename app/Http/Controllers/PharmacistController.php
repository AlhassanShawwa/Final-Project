<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacistRequest;
use App\Interfaces\Pharmacists\PharmacistRepositoryInterface;
use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    private $Pharmacists;
    public function __construct(PharmacistRepositoryInterface $Pharmacists)
    {
        $this->Pharmacists = $Pharmacists;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Pharmacists->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Pharmacists->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacistRequest $request)
    {
        return $this->Pharmacists->store($request);
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
        return $this->Pharmacists->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePharmacistRequest $request, string $id)
    {
        return $this->Pharmacists->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Pharmacists->destroy($id);
    }
}
