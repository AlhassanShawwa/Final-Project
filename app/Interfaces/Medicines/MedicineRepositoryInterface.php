<?php

namespace App\Interfaces\Medicines;

interface MedicineRepositoryInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function import($request);
    public function getMedicines();
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
