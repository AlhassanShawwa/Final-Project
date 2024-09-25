<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLapRequest;
use App\Interfaces\Laps\LapRepositoryInterface;
use Illuminate\Http\Request;

class LapController extends Controller
{
    private $Laps;
    public function __construct(LapRepositoryInterface $Laps)
    {
        $this->Laps = $Laps;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Laps->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Laps->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLapRequest $request)
    {
        return $this->Laps->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Laps->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Laps->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLapRequest $request, string $id)
    {
        return $this->Laps->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Laps->destroy($id);
    }
}
