<?php

namespace App\Interfaces\Departments;

interface DepartmentRepositoryInterface
{
    public function index($request);
    public function store($request);
    public function show($request, $id);
    public function edit($request);
    public function update($request, $id);
    public function destroy($id);
}
