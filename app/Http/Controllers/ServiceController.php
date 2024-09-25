<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Interfaces\Services\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    private $Services;
    public function __construct(ServiceRepositoryInterface $Services)
    {
        $this->Services = $Services;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Services->index($request);
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
    public function store(StoreServiceRequest $request)
    {
        return $this->Services->store($request);
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
        return $this->Services->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceRequest $request, string $id)
    {
        return $this->Services->update($request, $id);
    }
    /**
     * Get Status.
     */
    public function getStatus($id)
    {
        return $this->Services->getStatus($id);
    }
    /**
     * Update Status.
     */
    public function updateStatus(Request $request, $id)
    {
        return $this->Services->updateStatus($request, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Services->destroy($id);
    }
}
