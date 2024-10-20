<?php

namespace App\Interfaces\Prescriptions;

interface PrescriptionRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
