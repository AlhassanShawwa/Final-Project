<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function getStatus($id);
    public function updateStatus($request, $id);
    public function destroy($id);
}
