<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Interfaces\Tests\TestRepositoryInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $Tests;
    public function __construct(TestRepositoryInterface $Tests)
    {
        $this->Tests = $Tests;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->Tests->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestRequest  $request)
    {
        return $this->Tests->store($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Tests->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTestRequest $request, string $id)
    {
        return $this->Tests->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Tests->destroy($id);
    }
}
