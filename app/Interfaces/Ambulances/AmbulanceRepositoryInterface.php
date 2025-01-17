<?php

namespace App\Interfaces\Ambulances;

interface AmbulanceRepositoryInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);

    public function destroy($id);
}
