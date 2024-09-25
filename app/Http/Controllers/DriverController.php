<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Interfaces\Drivers\DriverRepositoryInterface;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    private $Drivers;
    public function __construct(DriverRepositoryInterface $Drivers)
    {
        $this->Drivers = $Drivers;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Drivers->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Drivers->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        return $this->Drivers->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Drivers->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Drivers->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDriverRequest $request, string $id)
    {
        return $this->Drivers->update($request, $id);
    }

    /**
     * Get Status.
     */
    public function getStatus($id)
    {
        return $this->Drivers->getStatus($id);
    }
    /**
     * Update Status.
     */
    public function updateStatus(Request $request, $id)
    {
        return $this->Drivers->updateStatus($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Drivers->destroy($id);
    }
}
