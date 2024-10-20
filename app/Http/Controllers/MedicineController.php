<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineRequest;
use App\Interfaces\Medicines\MedicineRepositoryInterface;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    private $Medicines;
    public function __construct(MedicineRepositoryInterface $Medicines)
    {
        $this->Medicines = $Medicines;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Medicines->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        return $this->Medicines->store($request);
    }

    public function import(Request $request)
    {
        return $this->Medicines->import($request);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Get Medicines .
     */
    public function getMedicines()
    {
        return $this->Medicines->getMedicines();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Medicines->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMedicineRequest $request, string $id)
    {
        return $this->Medicines->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Medicines->destroy($id);
    }
}
