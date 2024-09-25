<?php

namespace App\Interfaces\Tests;

interface TestRepositoryInterface
{
    public function index($request);
    public function store($request);
     public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
