<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Interfaces\Groups\GroupRepositoryInterface;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    private $Groups;
    public function __construct(GroupRepositoryInterface $Groups)
    {
        $this->Groups = $Groups;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Groups->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Groups->create();
    }

    public function get_services(string $id)
    {
        return $this->Groups->get_services($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        return $this->Groups->store($request);
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
        return $this->Groups->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Groups->update($request, $id);
    }
    /**
     * Get Status.
     */
    public function getStatus($id)
    {
        return $this->Groups->getStatus($id);
    }
    /**
     * Update Status.
     */
    public function updateStatus(Request $request, $id)
    {
        return $this->Groups->updateStatus($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Groups->destroy($id);
    }
}
